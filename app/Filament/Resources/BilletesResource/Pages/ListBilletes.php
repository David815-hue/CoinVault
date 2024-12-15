<?php

namespace App\Filament\Resources\BilletesResource\Pages;

use App\Filament\Resources\BilletesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBilletes extends ListRecords
{
    protected static string $resource = BilletesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
}
