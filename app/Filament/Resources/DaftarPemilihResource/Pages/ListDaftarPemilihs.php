<?php

namespace App\Filament\Resources\DaftarPemilihResource\Pages;

use App\Filament\Resources\DaftarPemilihResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarPemilihs extends ListRecords
{
    protected static string $resource = DaftarPemilihResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
