<?php

namespace App\Filament\Resources;

use App\Enums\JenisKelamin;
use App\Enums\StatusAktif;
use App\Enums\StatusDaftarPemilih;
use App\Filament\Resources\DaftarPemilihResource\Pages;
use App\Models\DaftarPemilih;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use KodePandai\Indonesia\Models\City;

class DaftarPemilihResource extends Resource
{
    protected static ?string $model = DaftarPemilih::class;

    protected static ?string $slug = 'daftar-pemilih';

    protected static ?string $label = 'Daftar Pemilih';

    protected static ?string $pluralLabel = 'Daftar Pemilih';

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required(),

                    TextInput::make('nik')
                        ->label('NIK Pemilih')
                        ->required(),

                    TextInput::make('no_kk')
                        ->label('No. Kartu Keluarga (KK)')
                        ->required(),

                    TextInput::make('notelp')
                        ->label('No. Telepon/WA')
                        ->required(),

                    Select::make('jenis_kelamin')
                        ->label('Jenis Kelamin')
                        ->default(JenisKelamin::LAKI)
                        ->options(JenisKelamin::class),

                    Select::make('provinsi')
                        ->required()
                        ->options(
                            Provinsi::all()->pluck('name', 'code')
                        )
                        ->afterStateUpdated(fn(callable $set) => $set('kabupaten', null))
                        ->lazy()
                        ->live()
                        ->default(config('custom.default.kodeprov'))
                        ->searchable(),
                    Select::make('kabupaten')
                        ->required()
                        ->options(function (callable $get) {
                            $prov = Kabupaten::query()->where('provinsi_code', $get('provinsi'));
                            if (!$prov) {
                                return City::where('provinsi_code', config('custom.default.kodeprov'))
                                    ->pluck('name', 'code');
                            }

                            return $prov->pluck('name', 'code');
                        })
                        ->afterStateUpdated(fn(callable $set) => $set('kecamatan', null))
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
                            if (!$kab) {
                                return Kabupaten::where('kabupaten_code', config('custom.default.kodekab'))
                                    ->pluck('name', 'code');
                            }

                            return $kab->pluck('name', 'code');
                        })
                        ->afterStateUpdated(fn(callable $set) => $set('kelurahan', null)),

                    Select::make('kelurahan')
                        ->required()
                        ->options(function (callable $get) {
                            $kel = Kelurahan::query()->where('kecamatan_code', $get('kecamatan'));
                            if (!$kel) {
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

                    TextInput::make('kode_pos')->label('Kode Pos'),

                    Select::make('status_daftar')
                        ->label('Status Aktif')
                        ->default(StatusAktif::NonAktif)
                        ->options(StatusAktif::class),

                    Select::make('status_pemilih')
                        ->label('Status Pemilih')
                        ->default(StatusDaftarPemilih::Sementara)
                        ->options(StatusDaftarPemilih::class),
                ])->columns(2),
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
                TextColumn::make('nama_lengkap'),

                TextColumn::make('nik'),

                TextColumn::make('no_kk'),

                TextColumn::make('alamat'),

                TextColumn::make('notelp'),

                TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->badge(),

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

                TextColumn::make('kode_pos'),

                TextColumn::make('status_pemilih'),

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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDaftarPemilih::route('/'),
            'create' => Pages\CreateDaftarPemilih::route('/create'),
            'edit' => Pages\EditDaftarPemilih::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_lengkap', 'nik', 'no_kk'];
    }
}
