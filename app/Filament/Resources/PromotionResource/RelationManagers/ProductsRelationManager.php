<?php

namespace App\Filament\Resources\PromotionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Product;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';
    
    protected static ?string $recordTitleAttribute = 'name';
    
    protected static ?string $title = 'Товары по акции';
    
    protected static ?string $modelLabel = 'товар';
    
    protected static ?string $pluralModelLabel = 'товары';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                    ->label('Товар')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Сбросить выбранные размеры при смене товара
                        $set('selected_sizes', []);
                    }),
                CheckboxList::make('selected_sizes')
                    ->label('Выберите граммовки')
                    ->options(function (callable $get) {
                        $productId = $get('product_id');
                        if (!$productId) {
                            return [];
                        }
                        
                        $product = Product::find($productId);
                        if (!$product || !$product->sizes) {
                            return [];
                        }
                        
                        $options = [];
                        foreach ($product->sizes as $size) {
                            if (isset($size['is_stock']) && $size['is_stock']) {
                                $sizeKey = $size['name'];
                                // Избегаем дублирования, используя размер как ключ
                                if (!isset($options[$sizeKey])) {
                                    $options[$sizeKey] = $size['name'] . ' г';
                                }
                            }
                        }
                        
                        return $options;
                    })
                    ->required()
                    ->helperText('Выберите конкретные граммовки этого товара для участия в акции')
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название товара')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30),
                Tables\Columns\TextColumn::make('category')
                    ->label('Категория')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('sizes')
                    ->label('Выбранные граммовки')
                    ->formatStateUsing(function ($record) {
                        $selectedSizes = $record->pivot->selected_sizes ?? [];
                        if (is_string($selectedSizes)) {
                            $selectedSizes = json_decode($selectedSizes, true) ?? [];
                        }
                        
                        if (empty($selectedSizes)) {
                            return 'Все размеры';
                        }
                        
                        // Удаляем дубликаты и сортируем
                        $uniqueSizes = collect($selectedSizes)
                            ->unique()
                            ->sort(SORT_NUMERIC)
                            ->map(fn($size) => $size . ' г');
                        
                        return $uniqueSizes->join(', ');
                    })
                    ->badge()
                    ->color('primary')
                    ->wrap(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Статус')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Добавлен')
                    ->since()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')
                    ->label('Статус товара')
                    ->placeholder('Все товары')
                    ->trueLabel('Только активные')
                    ->falseLabel('Только неактивные'),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Категория')
                    ->options(Product::distinct()->pluck('category', 'category')->toArray())
                    ->multiple(),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Добавить товар')
                    ->modalHeading('Добавить товар в акцию')
                    ->form([
                        Select::make('recordId')
                            ->label('Товар')
                            ->options(Product::where('status', true)->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('selected_sizes', []);
                            }),
                        CheckboxList::make('selected_sizes')
                            ->label('Выберите граммовки')
                            ->options(function (callable $get) {
                                $productId = $get('recordId');
                                if (!$productId) {
                                    return [];
                                }
                                
                                $product = Product::find($productId);
                                if (!$product || !$product->sizes) {
                                    return [];
                                }
                                
                                $options = [];
                                foreach ($product->sizes as $size) {
                                    if (isset($size['is_stock']) && $size['is_stock']) {
                                        $sizeKey = $size['name'];
                                        // Избегаем дублирования, используя размер как ключ
                                        if (!isset($options[$sizeKey])) {
                                            $options[$sizeKey] = $size['name'] . ' г - ' . 
                                                number_format($size['old_price'], 0, ',', ' ') . ' тг';
                                        }
                                    }
                                }
                                
                                return $options;
                            })
                            ->required()
                            ->helperText('Выберите конкретные граммовки для участия в акции')
                            ->columns(2),
                    ])
                    ->action(function (array $data, $livewire) {
                        $promotion = $livewire->ownerRecord;
                        
                        // Убираем дубликаты из выбранных размеров
                        $uniqueSizes = array_unique($data['selected_sizes'] ?? []);
                        
                        $promotion->products()->attach($data['recordId'], [
                            'selected_sizes' => json_encode(array_values($uniqueSizes))
                        ]);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Изменить граммовки')
                    ->icon('heroicon-o-pencil-square')
                    ->modalHeading('Изменить выбранные граммовки')
                    ->form([
                        CheckboxList::make('selected_sizes')
                            ->label('Выберите граммовки')
                            ->options(function ($record) {
                                $product = $record;
                                if (!$product || !$product->sizes) {
                                    return [];
                                }
                                
                                $options = [];
                                foreach ($product->sizes as $size) {
                                    if (isset($size['is_stock']) && $size['is_stock']) {
                                        $sizeKey = $size['name'];
                                        // Избегаем дублирования, используя размер как ключ
                                        if (!isset($options[$sizeKey])) {
                                            $options[$sizeKey] = $size['name'] . ' г - ' . 
                                                number_format($size['old_price'], 0, ',', ' ') . ' тг';
                                        }
                                    }
                                }
                                
                                return $options;
                            })
                            ->default(function ($record) {
                                $selectedSizes = $record->pivot->selected_sizes ?? '[]';
                                if (is_string($selectedSizes)) {
                                    return json_decode($selectedSizes, true) ?? [];
                                }
                                return $selectedSizes;
                            })
                            ->required()
                            ->columns(2),
                    ])
                    ->action(function (array $data, $record, $livewire) {
                        $promotion = $livewire->ownerRecord;
                        
                        // Убираем дубликаты из выбранных размеров
                        $uniqueSizes = array_unique($data['selected_sizes'] ?? []);
                        
                        $promotion->products()->updateExistingPivot($record->id, [
                            'selected_sizes' => json_encode(array_values($uniqueSizes))
                        ]);
                    }),
                Tables\Actions\DetachAction::make()
                    ->label('Удалить')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->label('Удалить выбранные'),
                ]),
            ])
            ->emptyStateHeading('Товары не добавлены')
            ->emptyStateDescription('Добавьте товары, которые участвуют в этой акции.')
            ->emptyStateIcon('heroicon-o-cube')
            ->defaultSort('created_at', 'desc');
    }
}
