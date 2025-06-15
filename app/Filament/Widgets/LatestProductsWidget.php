<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Product;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Последние продукты';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('price')->money('USD'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ]);
    }
}
