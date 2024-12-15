<?php

namespace App\Filament\Resources\BilletesResource\Pages;

use App\Filament\Resources\BilletesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBilletes extends EditRecord
{
    protected static string $resource = BilletesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
