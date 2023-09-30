<?php

namespace App\Filament\Resources\JenisCalonResource\Pages;

use App\Filament\Resources\JenisCalonResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJenisCalons extends ManageRecords
{
    protected static string $resource = JenisCalonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
