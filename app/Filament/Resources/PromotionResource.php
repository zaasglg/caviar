<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Filament\Resources\PromotionResource\RelationManagers;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $modelLabel = 'Акция';
    protected static ?string $pluralModelLabel = 'Акции';
    
    protected static ?int $navigationSort = 3;
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Grid::make(1)
                            ->schema([
                                Section::make('Основная информация')
                                    ->schema([
                                        TextInput::make('title')
                                            ->required() 
                                            ->label("Название акции")
                                            ->maxLength(255)
                                            ->placeholder('Введите название акции...')
                                            ->columnSpanFull(),
                                        RichEditor::make('description')
                                            ->label("Описание акции")
                                            ->placeholder('Детальное описание акции для внутренней страницы...')
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'link',
                                                'bulletList',
                                                'orderedList',
                                            ])
                                            ->columnSpanFull(),
                                        TextInput::make('url')
                                            ->label("Внешняя ссылка")
                                            ->url()
                                            ->placeholder('https://example.com')
                                            ->helperText('Ссылка на внешний ресурс (необязательно)')
                                            ->columnSpanFull(),
                                    ])
                                    ->icon('heroicon-o-information-circle'),
                                    
                                Section::make('Настройки отображения')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                Toggle::make('is_active')
                                                    ->label("Активная акция") 
                                                    ->helperText('Отображать акцию на сайте')
                                                    ->default(true),
                                                TextInput::make('sort_order')
                                                    ->numeric()
                                                    ->label("Порядок сортировки")
                                                    ->default(0)
                                                    ->minValue(0)
                                                    ->helperText('Чем меньше число, тем выше в списке'),
                                            ]),
                                    ])
                                    ->icon('heroicon-o-cog-6-tooth'),
                            ])
                            ->columnSpan(2),
                            
                        Grid::make(1)
                            ->schema([
                                Section::make('Изображения')
                                    ->schema([
                                        FileUpload::make('image_path')
                                            ->image()
                                            ->label("Изображение карточки")
                                            ->disk('public')
                                            ->directory('promotions/cards')
                                            ->visibility('public')
                                            ->required()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->maxSize(2048)
                                            ->helperText('Рекомендуемый размер: 800x450px. Отображается в списке акций.'),
                                        FileUpload::make('banner_image_path')
                                            ->image()
                                            ->label("Баннер страницы")
                                            ->disk('public')
                                            ->directory('promotions/banners')
                                            ->visibility('public')
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '21:9',
                                            ])
                                            ->maxSize(5120)
                                            ->helperText('Рекомендуемый размер: 1920x1080px. Большой баннер для страницы акции.'),
                                    ])
                                    ->icon('heroicon-o-photo'),
                                    
                                Section::make('Информация')
                                    ->schema([
                                        Placeholder::make('created_at')
                                            ->label('Создано')
                                            ->content(fn ($record): string => $record?->created_at?->diffForHumans() ?? '-'),
                                        Placeholder::make('updated_at')
                                            ->label('Обновлено')
                                            ->content(fn ($record): string => $record?->updated_at?->diffForHumans() ?? '-'),
                                    ])
                                    ->icon('heroicon-o-calendar')
                                    ->hidden(fn (?string $operation): bool => $operation === 'create'),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Превью')
                    ->size(60)
                    ->circular(),
                TextColumn::make('title')
                    ->label('Название акции')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Название скопировано!')
                    ->limit(30),
                TextColumn::make('description')
                    ->label('Описание')
                    ->html()
                    ->limit(60)
                    ->searchable()
                    ->toggleable()
                    ->placeholder('Без описания'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Статус')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('gray'),
                TextColumn::make('products_count')
                    ->label('Товары')
                    ->counts('products')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('url')
                    ->label('Ссылка')
                    ->searchable()
                    ->toggleable()
                    ->icon('heroicon-o-link')
                    ->limit(25)
                    ->placeholder('Нет ссылки'),
                TextColumn::make('created_at')
                    ->label('Создано')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Обновлено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->since(),
            ])
            ->filters([
                // Tables\Filters\TernaryFilter::make('is_active')
                //     ->label('Статус акции')
                //     ->placeholder('Все акции')
                //     ->trueLabel('Только активные')
                //     ->falseLabel('Только неактивные')
                //     ->icon('heroicon-o-eye'),
                // Tables\Filters\Filter::make('has_products')
                //     ->label('С товарами')
                //     ->query(fn (Builder $query): Builder => $query->has('products'))
                //     ->icon('heroicon-o-cube'),
                // Tables\Filters\Filter::make('no_description')
                //     ->label('Без описания')
                //     ->query(fn (Builder $query): Builder => $query->whereNull('description'))
                //     ->icon('heroicon-o-document-text'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn (Promotion $record): string => route('stock', ['id' => $record->id]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-eye')
                    ->color('info'),
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil-square'),
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Активировать')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Деактивировать')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->persistSortInSession()
            ->striped()
            ->paginated([10, 25, 50])
            ->poll('30s')
            ->deferLoading();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_active', true)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('is_active', true)->count() > 0 ? 'primary' : 'gray';
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with('products');
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'description'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Статус' => $record->is_active ? 'Активна' : 'Неактивна',
            'Товаров' => $record->products_count ?? $record->products->count(),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPromotions::route('/'), // Список акций
            'create' => Pages\CreatePromotion::route('/create'), // Создать акцию
            'edit' => Pages\EditPromotion::route('/{record}/edit'), // Редактировать акцию
        ];
    }
}
