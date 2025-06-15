<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GiftResource\Pages;
use App\Filament\Resources\GiftResource\RelationManagers;
use App\Models\Gift;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GiftResource extends Resource
{
    protected static ?string $model = Gift::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Магазин';
    protected static ?string $modelLabel = 'Подарочные сертификат';
    protected static ?string $pluralModelLabel = 'Подарочные сертификаты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Основное')
                ->schema([
                    TextInput::make('name')
                        ->label('Имя')
                        ->required(),

                    TextInput::make('old_price')
                        ->label('Цена')
                        ->required()
                        ->numeric()
                        ->inputMode('decimal'),
                        
                    TextInput::make('new_price')
                        ->label('Цена со скидкой')
                        ->numeric()
                        ->inputMode('decimal'),

                ]),

            Fieldset::make('Мультимедия')
                ->schema([
                    FileUpload::make('image')
                        ->required()
                        ->label('Фото')
                        ->disk('public'),

                    FileUpload::make('gallery')
                        ->multiple()
                        ->disk('public')
                        ->imageEditor()
                        ->panelLayout('grid')
                        ->label('Галерея')->required()
                ]),

            Fieldset::make('Описание')
                ->schema([
                    RichEditor::make('description')
                        ->required()
                        ->label('описание')
                ])
                ->columns(1),


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

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListGifts::route('/'),
            'create' => Pages\CreateGift::route('/create'),
            'edit' => Pages\EditGift::route('/{record}/edit'),
        ];
    }
}
