<?php

namespace App\Filament\Resources;

use App\Enums\StatusAktif;
use App\Filament\Resources\RelawanResource\Pages;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Relawan;
use App\Utilities\Helpers;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use KodePandai\Indonesia\Models\City;

class RelawanResource extends Resource
{
    protected static ?string $model = Relawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $slug = 'relawan';

    protected static ?string $pluralLabel = 'Relawan';

    protected static ?string $label = 'Relawan';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Data Pribadi')->schema([
                        Forms\Components\TextInput::make('nama_relawan')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\DatePicker::make('tgl_lahir')
                                ->timezone(config('app.timezone'))
                                ->format('d/m/Y')
                                ->displayFormat(config('custom.date.display_short'))
                                ->live(true)
                                ->afterStateUpdated(fn (Forms\Set $set, $state) => $set(
                                    'umur',
                                    Helpers::getUmur($state)
                                ))
                                ->required(),
                            Forms\Components\TextInput::make('umur')
                                ->disabled()
                                ->numeric(),
                        ]),

                        Forms\Components\TextInput::make('notelp')
                            ->label('No. Telp/WA')
                            ->tel()
                            ->required()
                            ->maxLength(14),
                        Forms\Components\TextInput::make('alamat')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('rt_rw')
                                ->label('RT/RW')
                                ->maxLength(10),
                            Forms\Components\TextInput::make('kodepos')
                                ->maxLength(6),
                        ]),
                    ]),

                    Forms\Components\Section::make('Kegiatan Kampanye')->schema([
                        Forms\Components\TextInput::make('kegiatan_id')
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('kampanye_id')
                            ->numeric()
                            ->default(1),
                        Forms\Components\TextInput::make('anggaran_id')
                            ->numeric()
                            ->default(1),
                    ])->hidden(),
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Wilayah Relawan')->schema([
                        Select::make('provinsi')
                            ->required()
                            ->options(
                                Provinsi::all()->pluck('name', 'code')
                            )
                            ->afterStateUpdated(fn (callable $set) => $set('kabupaten', null))
                            ->lazy()
                            ->live()
                            ->default(config('custom.default.kodeprov'))
                            ->searchable(),
                        Select::make('kabupaten')
                            ->required()
                            ->options(function (callable $get) {
                                $prov = Kabupaten::query()->where('provinsi_code', $get('provinsi'));
                                if (! $prov) {
                                    return City::where('provinsi_code', config('custom.default.kodeprov'))
                                        ->pluck('name', 'code');
                                }

                                return $prov->pluck('name', 'code');
                            })
                            ->afterStateUpdated(fn (callable $set) => $set('kecamatan', null))
                            ->live()
                            ->lazy()
                            ->default(config('custom.default.kodekab'))
                            ->searchable(),

                        Select::make('kecamatan')
                            ->required()
                            ->searchable()
                            ->live()
                            ->lazy()
                            ->options(function (callable $get) {
                                $kab = Kecamatan::query()->where('kabupaten_code', $get('kabupaten'));
                                if (! $kab) {
                                    return Kabupaten::where('kabupaten_code', config('custom.default.kodekab'))
                                        ->pluck('name', 'code');
                                }

                                return $kab->pluck('name', 'code');
                            })
                            ->afterStateUpdated(fn (callable $set) => $set('kelurahan', null)),

                        Select::make('kelurahan')
                            ->required()
                            ->options(function (callable $get) {
                                $kel = Kelurahan::query()->where('kecamatan_code', $get('kecamatan'));
                                if (! $kel) {
                                    return Kelurahan::where('kecamatan_code', '731211')
                                        ->pluck('name', 'code');
                                }

                                return $kel->pluck('name', 'code');
                            })
                            ->live()
                            ->lazy()
                            ->searchable()
                            ->afterStateUpdated(function (callable $set, $state) {
                                return Kelurahan::where('code', $state)->first();
                            }),
                    ]),
                    Forms\Components\Section::make('Status Relawan')->schema([
                        Forms\Components\Select::make('status_relawan')
                            ->hiddenLabel()
                            ->options(StatusAktif::class),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_relawan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('umur')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('notelp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kegiatan_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kampanye_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('anggaran_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('provinsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rt_rw')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kodepos')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status_relawan')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRelawans::route('/'),
            'create' => Pages\CreateRelawan::route('/create'),
            'view' => Pages\ViewRelawan::route('/{record}'),
            'edit' => Pages\EditRelawan::route('/{record}/edit'),
        ];
    }
}
