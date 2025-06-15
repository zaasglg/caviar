<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{

    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     // $data['products'] = json_decode($data['products'], true);
    //     // dd($data['products']);
    
    //     return $data;
    // }

    protected static string $resource = OrderResource::class;
}
