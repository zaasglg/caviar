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
                    ->label('Product')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
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
                    ->label('Размеры')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Нет размеров';
                        $sizes = collect($state)->pluck('name')->join(', ');
                        return $sizes ?: 'Нет размеров';
                    })
                    ->limit(30),
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
                    ->modalHeading('Выберите товары для акции')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['name', 'category'])
                    ->multiple(),
            ])
            ->actions([
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
