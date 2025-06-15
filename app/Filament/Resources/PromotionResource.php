<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Filament\Resources\PromotionResource\RelationManagers;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Акция';
    protected static ?string $pluralModelLabel = 'Акции';
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('title') // Название
                    ->required() 
                    ->label("название")
                    ->maxLength(255),
                FileUpload::make('image_path') // Путь к изображению
                    ->image()
                    ->label("изображение")
                    ->directory('promotions')
                    ->required(), // Обязательно
                TextInput::make('url')
                    ->label("Ссылка")
                    ->maxLength(255),
                Toggle::make('is_active')
                    ->label("Активно?") 
                    ->required(), // Обязательно
                TextInput::make('sort_order') // Порядок сортировки
                    ->numeric()
                    ->label("Порядок сортировки")
                    ->required() // Обязательно
                    ->default(0),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('title') // Название
                    ->searchable(), // Доступно для поиска
                ImageColumn::make('image_path'), // Путь к изображению
                TextColumn::make('url') // URL
                    ->searchable(), // Доступно для поиска
                ToggleColumn::make('is_active'), // Активно
                TextColumn::make('sort_order') // Порядок сортировки
                    ->numeric()
                    ->sortable(), // Сортируемо
                TextColumn::make('created_at') // Время создания
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at') // Время обновления
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Действие редактирования
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Действие массового удаления
                ]),
            ]);
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
