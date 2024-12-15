<?php

namespace App\Filament\Resources\MonedasResource\Pages;

use App\Filament\Resources\MonedasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonedas extends EditRecord
{
    protected static string $resource = MonedasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
