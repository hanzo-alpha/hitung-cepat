<?php

namespace App\Filament\Resources\HitungSuaraPartaiResource\Pages;

use App\Filament\Resources\HitungSuaraPartaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHitungSuaraPartais extends ManageRecords
{
    protected static string $resource = HitungSuaraPartaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
