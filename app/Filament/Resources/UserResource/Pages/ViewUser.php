<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['created_at'] = Carbon::parse($data['created_at'])->format('Y-m-d');
    
        return $data;
    }

    protected static string $resource = UserResource::class;
}
