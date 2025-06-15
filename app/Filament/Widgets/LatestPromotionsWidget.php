<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Promotion;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPromotionsWidget extends BaseWidget
{
    protected static ?string $heading = 'Последние акции';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Promotion::latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ]);
    }
}
