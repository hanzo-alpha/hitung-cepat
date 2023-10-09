<?php

namespace App\Filament\Resources\TpsResource\Pages;

use App\Filament\Resources\TpsResource;
use App\Models\DataTps;
use App\Models\Tps;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageTps extends ManageRecords
{
    protected static string $resource = TpsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->mutateFormDataUsing(function (array $data) {
                    $data['nama_tps'] = 'TPS';
                    $data['persentase'] = 0.0;

                    return $data;
                })
                ->using(function (array $data) {
                    $data['nama_tps'] = config('custom.nama_tps', 'TPS') . ' ' . $data['jumlah_tps'];
                    $insertTps = Tps::create($data);
                    $lastInsertId = $insertTps->id;
                    for ($i = 1; $i <= $data['jumlah_tps']; $i++) {
                        $namaTps = config('custom.nama_tps', 'TPS') . ' ' . $i;
                        DataTps::create([
                            'tps_id' => $lastInsertId,
                            'nama_tps' => $namaTps,
                        ]);
                    }

                    return $insertTps;
                })
                ->after(function (array $data) {
                    Notification::make()
                        ->title($data['jumlah_tps'] . ' TPS Berhasil ditambahkan')
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
