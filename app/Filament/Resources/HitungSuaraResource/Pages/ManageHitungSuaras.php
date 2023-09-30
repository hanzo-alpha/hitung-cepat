<?php

namespace App\Filament\Resources\HitungSuaraResource\Pages;

use App\Filament\Resources\HitungSuaraResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHitungSuaras extends ManageRecords
{
    protected static string $resource = HitungSuaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
