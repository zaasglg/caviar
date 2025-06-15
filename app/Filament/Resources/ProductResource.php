<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Toggle;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'Магазин';

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $modelLabel = 'Товар';
    protected static ?string $pluralModelLabel = 'Товары';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Основное')
                    ->schema([
                        TextInput::make('name')
                            ->label('Имя')
                            ->required(),

                        TextInput::make('category')
                            ->label('Катагория')
                            ->required(),

                        Select::make('catalog_id')
                            ->relationship('catalog', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Toggle::make('status')
                            ->label('доступно')
                            ->inline(false)
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user')
                    ]),

                Fieldset::make('Мультимедия')
                    ->schema([
                        FileUpload::make('image')
                            ->required()
                            ->label('Фото')
                            ->disk('public')
                            ->optimize('webp')
                    ]),

                Fieldset::make('Описание')
                    ->schema([
                        RichEditor::make('description')
                            ->required()
                            ->label('описание')
                    ])
                    ->columns(1),

                Fieldset::make('Характеристики')
                    ->schema([
                        TextInput::make('expiration_date')
                            ->label('Срок годности')
                            ->required(), 
                        TextInput::make('storage_conditions')
                            ->label('Условия хранения')
                            ->required(),
                        TextInput::make('made_by')
                            ->label('Изготовлено по')
                            ->required(),
                        TextInput::make('composition')
                            ->label('Состав')
                            ->required(),
                        TextInput::make('food_value')
                            ->label('Пищевая ценность')
                            ->required(),
                        TextInput::make('energy_value')
                            ->label('Энергетическая ценность')
                            ->required(),
                    ]),

                Fieldset::make('Весы')
                    ->schema([
                        Repeater::make('sizes')
                            ->schema([
                                
                                Fieldset::make()
                                    ->schema([
                                        TextInput::make('name')
                                            ->live(onBlur:true)
                                            ->label('Вес')->required(),

                                        TextInput::make('old_price')
                                            ->label('Цена')
                                            ->required()
                                            ->numeric()
                                            ->inputMode('decimal'),
                                            
                                        TextInput::make('new_price')
                                            ->label('Цена со скидкой')
                                            ->numeric()
                                            ->inputMode('decimal'),
										
										Toggle::make('is_stock')
											->label('доступно')
                                            ->inline(false)
											->onIcon('heroicon-m-bolt')
											->offIcon('heroicon-m-user')
                                    ]),

                                FileUpload::make('attachments')
                                    ->multiple()
                                    ->disk('public')
                                    ->imageEditor()
                                    ->panelLayout('grid')
                                    ->label('Галерея')
                                    ->optimize('webp')
                                    ->required()
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->columns(2)
                            ->label('Весы')
                            ->defaultItems(1)
                            ->collapsible()
                            ->cloneable()
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Фото'),

                TextColumn::make('name')
                    ->label('Имя')
                    ->searchable(),

                TextColumn::make('catalog.name')
                    ->label('Каталог')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('copy')
                    ->label('Копировать')
                    ->icon('heroicon-o-document-duplicate')
                    ->action(function (Product $record) {

                        $newProduct = $record->replicate();
                        $newProduct->save();

                        return redirect()->back();
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
