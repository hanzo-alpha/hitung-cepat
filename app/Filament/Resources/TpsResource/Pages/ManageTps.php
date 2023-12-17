<?php

namespace App\Filament\Resources\TpsResource\Pages;

use App\Filament\Resources\TpsResource;
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
                ->using(function (array $data) {
                    $data['nama_tps'] = $data['jumlah_tps'] . ' ' . config('custom.nama_tps', 'TPS');
                    $insertTps = Tps::updateOrCreate([
                        'provinsi' => $data['provinsi'],
                        'kabupaten' => $data['kabupaten'],
                        'kecamatan' => $data['kecamatan'],
                        'kelurahan' => $data['kelurahan'],
                    ], $data);
                    $lastInsertId = $insertTps->id;
                    for ($i = 1; $i <= $data['jumlah_tps']; $i++) {
                        $namaTps = config('custom.nama_tps', 'TPS') . ' ' . $i;
                        $insertTps->data_tps()->updateOrCreate([
                            'tps_id' => $lastInsertId,
                            'nama_tps' => $namaTps,
                        ], [
                            'tps_id' => $lastInsertId,
                            'nama_tps' => $namaTps,
                        ]);
                    }

                    return $insertTps;
                })
                ->after(function (array $data) {
                    Notification::make()
                        ->success()
                        ->title($data['jumlah_tps'] . ' TPS Berhasil ditambahkan')
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
