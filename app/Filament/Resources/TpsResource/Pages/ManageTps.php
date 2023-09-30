<?php

namespace App\Filament\Resources\TpsResource\Pages;

use App\Filament\Resources\TpsResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTps extends ManageRecords
{
    protected static string $resource = TpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    $data['nama_tps'] = 'TPS';

                    return $data;
                }),
        ];
    }
}
