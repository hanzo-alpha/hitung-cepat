<?php

namespace App\Filament\Resources\DapilResource\Pages;

use App\Filament\Resources\DapilResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDapils extends ManageRecords
{
    protected static string $resource = DapilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus'),
        ];
    }
}
