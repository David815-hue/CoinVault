<?php

namespace App\Filament\Resources\MonedasResource\Pages;

use App\Filament\Resources\MonedasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonedas extends ListRecords
{
    protected static string $resource = MonedasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Agregar'),
        ];
    }
}
