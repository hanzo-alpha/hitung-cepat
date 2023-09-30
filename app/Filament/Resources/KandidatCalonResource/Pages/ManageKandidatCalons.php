<?php

namespace App\Filament\Resources\KandidatCalonResource\Pages;

use App\Filament\Resources\KandidatCalonResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKandidatCalons extends ManageRecords
{
    protected static string $resource = KandidatCalonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
