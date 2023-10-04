<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuickCountResource\Pages;
use App\Models\Partai;
use App\Models\QuickCount;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;

class QuickCountResource extends Resource
{
    protected static ?string $model = QuickCount::class;

    protected static ?string $slug = 'suara-calon';

    protected static ?string $label = 'Suara Calon';

    protected static ?string $pluralLabel = 'Suara Calon';

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tps_id')
                    ->label('TPS')
                    ->relationship('data_tps', 'nama_tps')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return '<strong>' . $record->nama_tps . '</strong><br>' .
                            $record->tps->kec->name . ' | ' .
                            $record->tps->kel->name;
                    })->allowHtml()
                    ->searchable()
                    ->preload()
                    ->lazy()
                    ->unique()
                    ->required()
                    ->optionsLimit(15)
                    ->live(true),
                Select::make('caleg_id')
                    ->label('Caleg')
                    ->relationship('caleg', 'nama_caleg')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        $partai = Partai::find($record->partai_id);

                        return '<strong>' . $record->nama_caleg . '</strong> - ' . $partai->nama_partai;
                    })->allowHtml()
                    ->createOptionForm([
                        TextInput::make('nama_caleg')
                            ->label('Nama Caleg')
                            ->autofocus()
                            ->required(),
                        Select::make('partai_id')
                            ->label('Partai')
                            ->required()
                            ->lazy()
                            ->unique()
                            ->preload()
                            ->default(25)
                            ->searchable()
                            ->optionsLimit(15)
                            ->relationship('partai', 'nama_partai')
                            ->columnSpanFull(),
                        Select::make('jenis_pemilihan_id')
                            ->required()
                            ->default(1)
                            ->relationship('jenisPemilihan', 'nama_institusi'),
                    ])
                    ->preload()
                    ->searchable()
                    ->lazy()
                    ->required()
                    ->optionsLimit(15)
                    ->live(true),

                TextInput::make('jumlah_suara')
                    ->numeric()
//                    ->live(true)
//                    ->lazy()
//                    ->afterStateUpdated(function (Get $get, Set $set) {
//                        $persentase = Helpers::hitungPresentase($get('jumlah_suara'));
//
//                        return $set('persentase', $persentase);
//                    })
                    ->default(0),

                //                TextInput::make('persentase')
                //                    ->disabled()
                //                    ->default(0),

                Select::make('status_suara')
                    ->default('SUARA SEMENTARA')
                    ->options(config('custom.status.suara')),
            ])->columns(1)->inlineLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('10s')
            ->emptyStateDescription('Setelah Anda mengisi form pertama Anda, hasilnya akan muncul di sini')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Buat Suara Calon')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('tps.nama_tps')
                    ->label('TPS')
                    ->description(fn ($record): string => $record->tps->kec->name . ' | ' . $record->tps->kel->name)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('caleg.nama_caleg')
                    ->label('Nama Calon')
                    ->description(fn ($record): string => $record->caleg->first()->partai->first()->nama_partai)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_suara')
                    ->label('Jumlah Suara')
                    ->alignCenter()
                    ->toggleable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('persentase')
                    ->alignCenter()
                    ->formatStateUsing(fn ($state) => $state * 100 . '%')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_suara')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (int $state): string => match ($state) {
                        1 => 'SUARA SAH',
                        2 => 'SUARA TIDAK SAH',
                        3 => 'SUARA SEMENTARA',
                    })
                    ->icon(fn (int $state): string => match ($state) {
                        1 => 'heroicon-o-check-circle',
                        2 => 'heroicon-minus-circle',
                        3 => 'heroicon-o-pause-circle',
                    })
                    ->iconPosition(IconPosition::Before)
                    ->color(fn (int $state): string => match ($state) {
                        1 => 'success',
                        2 => 'danger',
                        3 => 'warning',
                    })
                    ->alignCenter()
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('caleg_id')
                    ->label('Berdasarkan calon')
                    ->relationship('caleg', 'nama_caleg')
                    ->searchable()
                    ->optionsLimit(15)
                    ->preload(),
                Tables\Filters\SelectFilter::make('status_suara')
                    ->label('Berdasarkan status suara')
                    ->options(config('custom.status.suara')),
            ])->persistFiltersInSession()
            ->filtersTriggerAction(fn (Tables\Actions\Action $action) => $action->button()->label('Filter'))
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
            'index' => Pages\ManageQuickCounts::route('/'),
        ];
    }
}
