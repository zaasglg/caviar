<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;

class SalesOverviewWidget extends ChartWidget
{
    protected static ?string $heading = 'Обзор продаж';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Total Sales',
                    'data' => [Order::sum('total_price')],
                ],
            ],
            'labels' => ['Total Sales'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
