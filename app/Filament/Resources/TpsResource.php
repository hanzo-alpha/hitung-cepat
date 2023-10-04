<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TpsResource\Pages;
use App\Models\Tps;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use KodePandai\Indonesia\Models\City;
use KodePandai\Indonesia\Models\District;
use KodePandai\Indonesia\Models\Province;
use KodePandai\Indonesia\Models\Village;

class TpsResource extends Resource
{
    protected static ?string $model = Tps::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    protected static ?string $label = 'Tempat Pemungutan Suara (TPS)';

    protected static ?string $navigationLabel = 'TPS';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()->schema([
                        TextInput::make('jumlah_tps')
                            ->label('Jumlah TPS')
                            ->helperText('Jumlah TPS yang akan digenerate otomatis. Ex: TPS 1, TPS 2, dst, sesuai jumlah yang dimasukkan')
                            ->required(),
                        //                        TableRepeater::make('data_tps')
                        //                            ->relationship('data_tps')
                        //                            ->required()
                        //                            ->minItems(1)
                        //                            ->label('Nama TPS')
                        //                            ->schema([
                        //                                Forms\Components\TextInput::make('nama_tps')->required(),
                        //                            ])
                        //                            ->withoutHeader()
                        //                            ->hideLabels(),
                    ])->columnSpanFull(),
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()->schema([
                        Select::make('provinsi')
                            ->required()
                            ->options(
                                Province::all()
                                    ->pluck('name', 'code')
                            )
                            ->afterStateUpdated(fn (callable $set) => $set('kabupaten', null))
                            ->live()
                            ->default(config('custom.default.kodeprov'))
                            ->searchable(),
                        Select::make('kabupaten')
                            ->required()
                            ->options(function (callable $get) {
                                $prov = City::query()->where('province_code', $get('provinsi'));
                                if (! $prov) {
                                    return City::where('province_code', config('custom.default.kodeprov'))
                                        ->pluck('name', 'code');
                                }

                                return $prov->pluck('name', 'code');
                            })
                            ->afterStateUpdated(fn (callable $set) => $set('kecamatan', null))
                            ->live()
                            ->default(config('custom.default.kodekab'))
                            ->searchable(),

                        Select::make('kecamatan')
                            ->required()
                            ->searchable()
                            ->live()
                            ->options(function (callable $get) {
                                $kab = District::query()->where('city_code', $get('kabupaten'));
                                if (! $kab) {
                                    return District::where('city_code', config('custom.default.kodekab'))
                                        ->pluck('name', 'code');
                                }

                                return $kab->pluck('name', 'code');
                            })
//                            ->hidden(fn (callable $get) => ! $get('kabupaten'))
                            ->afterStateUpdated(fn (callable $set) => $set('kelurahan', null)),

                        Select::make('kelurahan')
                            ->required()
                            ->options(function (callable $get) {
                                $kel = Village::query()->where('district_code', $get('kecamatan'));
                                if (! $kel) {
                                    return Village::where('district_code', '731211')
                                        ->pluck('name', 'code');
                                }

                                return $kel->pluck('name', 'code');
                            })
                            ->live()
                            ->searchable()
//                            ->hidden(fn (callable $get) => ! $get('kecamatan'))
                            ->afterStateUpdated(function (callable $set, $state) {
                                $village = Village::where('code', $state)->first();
                                if ($village) {
                                    $set('latitude', $village['latitude']);
                                    $set('longitude', $village['longitude']);
                                    $set('kode_pos', $village['postal_code']);
                                    $set('location', [
                                        'lat' => (float) $village['latitude'],
                                        'lng' => (float) $village['longitude'],
                                    ]);
                                }
                            }),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('nama_tps', 'asc')
            ->defaultGroup('kec.name')
            ->groups([
                Tables\Grouping\Group::make('prov.name')
                    ->label('Provinsi')
                    ->collapsible()
                    ->titlePrefixedWithLabel(false),
                Tables\Grouping\Group::make('kab.name')
                    ->label('Kabupaten')
                    ->collapsible()
                    ->titlePrefixedWithLabel(false),
                Tables\Grouping\Group::make('kec.name')
                    ->label('Kecamatan')
                    ->collapsible()
                    ->titlePrefixedWithLabel(false),
                Tables\Grouping\Group::make('kel.name')
                    ->label('Kelurahan')
                    ->collapsible()
                    ->titlePrefixedWithLabel(false),
            ])
            ->columns([

                Tables\Columns\TextColumn::make('data_tps.nama_tps')
                    ->label('Nama TPS')
                    ->badge()
                    ->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('prov.name')
                    ->label('Provinsi')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kab.name')
                    ->label('Kabupaten')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kec.name')
                    ->label('Kecamatan')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kel.name')
                    ->label('Kelurahan/Desa')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTps::route('/'),
        ];
    }
}
