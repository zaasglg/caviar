<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Магазин';
    
    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';

    protected static ?string $modelLabel = 'Заявка';
    protected static ?string $pluralModelLabel = 'Заявки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("name")
                    ->readOnly()
                    ->label('Имя клиента'),
                TextInput::make("phone_number")
                    ->readOnly()
                    ->label('Телефон номер'),
                TextInput::make("email")
                    ->readOnly()
                    ->label('Почта'),
                Textarea::make("comment")
                    ->readOnly()
                    ->label('Коментарий'),

                TextInput::make('total_price')
                    ->readOnly()
                    ->label('Общая сумма'),

                TextInput::make('type')
                    ->readOnly()
                    ->label('Метод оплаты'),


                Section::make()
                    ->schema([
                        Repeater::make('products')
                            ->schema([

                                Fieldset::make()
                                    ->schema([
                                        TextInput::make('name')
                                        ->label("Наименование"),
            
                                        TextInput::make('qty')
                                            ->label("Количество"),
                
                                        TextInput::make('price')
                                            ->label("Цена"),

                                        TextInput::make('weight')
                                        ->label("Вес"),
            
                                        // TextInput::make('name')
                                        //     ->label("Фото"),

                                        FileUpload::make('options.hero')
                                            ->required()
                                            ->label('Фото')
                                            ->disk('public'),
                                    ]),

                            ])
                            ->label("Список товаров")
                            ->columns(1)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Имя клиента'),
                TextColumn::make('phone_number')
                    ->label('Телефон номер'),
                TextColumn::make('email')
                    ->label('Почта'),
                TextColumn::make('total_price')
                    ->label('Общая сумма'),
                TextColumn::make('type')
                    ->label('Метод оплаты'),
                TextColumn::make('comment')
                    ->label('Коментарий'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
