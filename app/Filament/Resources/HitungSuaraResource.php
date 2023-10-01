<?php

namespace App\Filament\Resources;

use App\Enums\StatusSuara;
use App\Filament\Resources\HitungSuaraResource\Pages;
use App\Models\HitungSuara;
use App\Models\KandidatCalon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Wallo\FilamentSelectify\Components\ToggleButton;

class HitungSuaraResource extends Resource
{
    protected static ?string $model = HitungSuara::class;

    protected static ?string $slug = 'hitung-suara';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tps_id')
                    ->label('TPS')
                    ->relationship('tps', 'nama_tps')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nama_tps')->label('Nama TPS'),
                    ])
                    ->searchable()
                    ->preload()
                    ->lazy()
                    ->optionsLimit(10)
                    ->live(true),
                Forms\Components\Select::make('kandidat_calon_id')
                    ->label('Kandidat Calon')
                    ->relationship('kandidat_calon', 'nama_kandidat_1')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nama_kandidat_1')->label('Nama Kandidat Calon'),
                        Forms\Components\TextInput::make('nama_kandidat_2')->label('Nama Kandidat Calon Wakil'),
                    ])
                    ->getOptionLabelFromRecordUsing(fn (
                        KandidatCalon $record
                    ) => (string) ($record->nama_kandidat_1) . '/' . (string) ($record->nama_kandidat_2))
                    ->preload()
                    ->searchable()
                    ->lazy()
                    ->optionsLimit(10)
                    ->live(true),
                Forms\Components\TextInput::make('jumlah_suara_sah')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('jumlah_suara_tidak_sah')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('total_suara')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('persentase')
                    ->numeric()
                    ->default(0.00),

                Forms\Components\Select::make('status_suara')
                    ->options(StatusSuara::class),

                ToggleButton::make('status_suara')
                    ->label('Apakah Suara Aktif/Non Aktif')
                    ->offColor('danger')
                    ->onColor('primary')
                    ->offLabel('Tidak')
                    ->onLabel('Ya')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('tps_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kandidat_calon_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_suara_sah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_suara_tidak_sah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_suara')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('persentase')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status_suara')
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageHitungSuaras::route('/'),
        ];
    }
}
