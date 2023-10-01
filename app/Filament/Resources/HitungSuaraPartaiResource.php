<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HitungSuaraPartaiResource\Pages;
use App\Models\HitungSuaraPartai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HitungSuaraPartaiResource extends Resource
{
    protected static ?string $model = HitungSuaraPartai::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $slug = 'suara-partai';

    protected static ?string $label = 'Suara Partai';

    protected static ?string $pluralLabel = 'Suara Partai';

    //    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('partai_id')
                    ->relationship('partai', 'nama_partai')
                    ->lazy()
                    ->preload()
                    ->optionsLimit(15)
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('jenis_pemilihan_id')
                    ->label('Jenis Pemilihan')
                    ->relationship('jenisPemilihan', 'nama_institusi')
                    ->lazy()
                    ->preload()
                    ->optionsLimit(15)
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('jumlah_suara_partai')
                    ->label('Jumlah Suara')
                    ->integer()
                    ->default(0),
                Forms\Components\TextInput::make('jumlah_dapil')
                    ->label('Jumlah Dapil')
                    ->integer()
                    ->default(0),
                Forms\Components\TextInput::make('jumlah_kursi')
                    ->label('Jumlah Kursi')
                    ->integer()
                    ->default(0),
                //                ToggleButton::make('status_hitung')
                //                    ->label('Status Aktif Perhitungan')
                //                    ->offColor('danger')
                //                    ->onColor('primary')
                //                    ->offLabel('Tidak')
                //                    ->onLabel('Ya')
                //                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('partai.alias')
                    ->label('Nama Partai')
                    ->description(fn ($record): string => $record->partai->nama_partai)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisPemilihan.nama_institusi')
                    ->label('Jenis Pemilihan')
                    ->badge()
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_suara_partai')
                    ->label('Jumlah Suara')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_dapil')
                    ->label('Jumlah Dapil')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_kursi')
                    ->label('Jumlah Kursi')
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                //                Tables\Columns\IconColumn::make('status_hitung')
                //                ->alignCenter()
                //                    ->searchable()
                //                    ->sortable()
                //                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ManageHitungSuaraPartais::route('/'),
        ];
    }
}
