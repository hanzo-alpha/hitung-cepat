<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TpsResource\Pages;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Tps;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use KodePandai\Indonesia\Models\City;

class TpsResource extends Resource
{
    protected static ?string $model = Tps::class;

    //    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

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
                            ->hiddenOn('edit')
                            ->required(),
                        TableRepeater::make('data_tps')
                            ->relationship('data_tps')
                            ->required()
                            ->hiddenOn('create')
                            ->minItems(1)
                            ->label('Nama TPS')
                            ->schema([
                                Forms\Components\TextInput::make('nama_tps')->required(),
                            ])
                            ->withoutHeader()
                            ->hideLabels(),
                    ])->columnSpanFull(),
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make()->schema([
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
                    ->toggledHiddenByDefault()
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
                    ->label('Kelurahan Desa')
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_tps')
                    ->label('Jumlah')
                    ->alignCenter()
                    ->counts('data_tps'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kabupaten')
                    ->relationship('kab', 'name')
                    ->multiple()
                    ->searchable()
                    ->optionsLimit(20),
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->relationship('kec', 'name')
                    ->multiple()
                    ->searchable()
                    ->optionsLimit(20),
                Tables\Filters\SelectFilter::make('kelurahan')
                    ->relationship('kel', 'name')
                    ->multiple()
                    ->searchable()
                    ->optionsLimit(20),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->action(function ($record) {
                            $record->data_tps()->delete();
                            $record->delete();

                            Notification::make()
                                ->title('Data TPS berhasil dihapus')
                                ->sendToDatabase(auth()->user());
                        })
                        ->successNotificationTitle('Data TPS berhasil dihapus'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            $records->each(fn (Model $record) => $record->data_tps()->delete());
                            $records->each(fn (Model $record) => $record->delete());

                            Notification::make()
                                ->title($records->count() . ' Data TPS berhasil dihapus')
                                ->sendToDatabase(auth()->user());
                        })
                        ->successNotificationTitle('Data yang dipilih berhasil dihapus')
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DetachBulkAction::make(),
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
