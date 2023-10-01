<?php

namespace App\Filament\Resources\CalegResource\Pages;

use App\Filament\Resources\CalegResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCalegs extends ManageRecords
{
    protected static string $resource = CalegResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->successNotificationTitle('Caleg berhasil disimpan'),
        ];
    }
}
