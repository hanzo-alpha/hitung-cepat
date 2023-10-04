<?php

namespace App\Filament\Resources\JenisPemilihanResource\Pages;

use App\Filament\Resources\JenisPemilihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageJenisPemilihans extends ManageRecords
{
    protected static string $resource = JenisPemilihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->successNotificationTitle('Jenis Pemilihan Berhasil Ditambahkan'),
        ];
    }
}
