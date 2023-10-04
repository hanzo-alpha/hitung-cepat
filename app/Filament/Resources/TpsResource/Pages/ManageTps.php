<?php

namespace App\Filament\Resources\TpsResource\Pages;

use App\Filament\Resources\TpsResource;
use App\Models\DataTps;
use App\Models\Tps;
use App\Utilities\Helpers;
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
                    $data['persentase'] = Helpers::hitungPresentase($data['jumlah_suara']);

                    return $data;
                })
                ->using(function (array $data) {
                    $data['nama_tps'] = 'TPS ' . $data['jumlah_tps'];
                    $insertTps = Tps::create($data);
                    $lastInsertId = $insertTps->id;
                    for ($i = 1; $i <= $data['jumlah_tps']; $i++) {
                        $namaTps = 'TPS ' . $i;
                        DataTps::create([
                            'tps_id' => $lastInsertId,
                            'nama_tps' => $namaTps,
                        ]);
                    }

                    return $insertTps;
                })
                ->after(function () {
                    Notification::make()
                        ->title('TPS Berhasil ditambahkan')
                        ->sendToDatabase(auth()->user());
                }),
            //            Actions\CreateAction::make('generate')
            //                ->model(Tps::class)
            //                ->label('Buat TPS Otomatis')
            //                ->icon('heroicon-o-plus')
            //                ->color('warning')
            //                ->form([
            //                    Section::make()->schema([
            //                        TextInput::make('jumlah_tps')->label('Jumlah TPS')->required(),
            //                    ])->inlineLabel(),
            //                    Group::make()->schema([
            //                        Section::make()->schema([
            //                            Select::make('provinsi')
            //                                ->required()
            //                                ->options(
            //                                    Province::all()
            //                                        ->pluck('name', 'code')
            //                                )
            //                                ->afterStateUpdated(fn (callable $set) => $set('kabupaten', null))
            //                                ->live()
            //                                ->default(config('custom.default.kodeprov'))
            //                                ->searchable(),
            //                            Select::make('kabupaten')
            //                                ->required()
            //                                ->options(function (callable $get) {
            //                                    $prov = City::query()->where('province_code', $get('provinsi'));
            //                                    if (! $prov) {
            //                                        return City::where('province_code', config('custom.default.kodeprov'))
            //                                            ->pluck('name', 'code');
            //                                    }
            //
            //                                    return $prov->pluck('name', 'code');
            //                                })
            //                                ->afterStateUpdated(fn (callable $set) => $set('kecamatan', null))
            //                                ->live()
            //                                ->default(config('custom.default.kodekab'))
            //                                ->searchable(),
            //
            //                            Select::make('kecamatan')
            //                                ->required()
            //                                ->searchable()
            //                                ->live()
            //                                ->options(function (callable $get) {
            //                                    $kab = District::query()->where('city_code', $get('kabupaten'));
            //                                    if (! $kab) {
            //                                        return District::where('city_code', config('custom.default.kodekab'))
            //                                            ->pluck('name', 'code');
            //                                    }
            //
            //                                    return $kab->pluck('name', 'code');
            //                                })
            ////                            ->hidden(fn (callable $get) => ! $get('kabupaten'))
            //                                ->afterStateUpdated(fn (callable $set) => $set('kelurahan', null)),
            //
            //                            Select::make('kelurahan')
            //                                ->required()
            //                                ->options(function (callable $get) {
            //                                    $kel = Village::query()->where('district_code', $get('kecamatan'));
            //                                    if (! $kel) {
            //                                        return Village::where('district_code', '731211')
            //                                            ->pluck('name', 'code');
            //                                    }
            //
            //                                    return $kel->pluck('name', 'code');
            //                                })
            //                                ->live()
            //                                ->searchable()
            ////                            ->hidden(fn (callable $get) => ! $get('kecamatan'))
            //                                ->afterStateUpdated(function (callable $set, $state) {
            //                                    $village = Village::where('code', $state)->first();
            //                                    if ($village) {
            //                                        $set('latitude', $village['latitude']);
            //                                        $set('longitude', $village['longitude']);
            //                                        $set('kode_pos', $village['postal_code']);
            //                                        $set('location', [
            //                                            'lat' => (float) $village['latitude'],
            //                                            'lng' => (float) $village['longitude'],
            //                                        ]);
            //                                    }
            //                                }),
            //                        ]),
            //                    ])->inlineLabel(),
            //                ])
            //                ->using(function (array $data) {
            //                    $data['nama_tps'] = 'TPS ' . $data['jumlah_tps'];
            //                    $insertTps = Tps::create($data);
            //                    $lastInsertId = $insertTps->id;
            //                    for ($i = 1; $i <= $data['jumlah_tps']; $i++) {
            //                        $namaTps = 'TPS ' . $i;
            //                        DataTps::create([
            //                            'tps_id' => $lastInsertId,
            //                            'nama_tps' => $namaTps,
            //                        ]);
            //                    }
            //
            //                    return $insertTps;
            //                })
            //                ->after(function () {
            //                    Notification::make()
            //                        ->title('TPS Berhasil dibuat')
            //                        ->sendToDatabase(auth()->user());
            //                }),
        ];
    }
}
