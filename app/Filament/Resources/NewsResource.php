<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $modelLabel = 'Пост';
    protected static ?string $pluralModelLabel = 'Посты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Имя')
                    ->columnSpanFull()
                    ->required(),

                Toggle::make('banner')
                    ->label('banner')
                    ->columnSpanFull()
                    ->required(),


                FileUpload::make('hero')
                    ->label('Фото')
                    ->required()
                    ->columnSpanFull()
                    ->disk('public')
                    ->optimize('webp'),
				
				Textarea::make('exception')
					->label('краткое описание')
					->required()
				    ->columnSpanFull(),


                RichEditor::make('description')
                    ->label('Описание')
                    ->columnSpanFull()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),


                Tables\Actions\Action::make('copy')
                    ->label('Копировать')
                    ->icon('heroicon-o-document-duplicate')
                    ->action(function (News $record) {

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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
