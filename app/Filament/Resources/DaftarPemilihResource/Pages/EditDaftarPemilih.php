<?php

namespace App\Filament\Resources\DaftarPemilihResource\Pages;

use App\Filament\Resources\DaftarPemilihResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDaftarPemilih extends EditRecord
{
    protected static string $resource = DaftarPemilihResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
