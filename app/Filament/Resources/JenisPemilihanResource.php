<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPemilihanResource\Pages;
use App\Models\JenisPemilihan;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Wallo\FilamentSelectify\Components\ToggleButton;

class JenisPemilihanResource extends Resource
{
    protected static ?string $model = JenisPemilihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $slug = 'jenis-pemilihan';

    protected static ?string $pluralLabel = 'Jenis Pemilihan';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_institusi')
                    ->label('Nama Institusi')
                    ->required(),

                TextInput::make('tingkat_pemilihan')
                    ->label('Tingkat Pemilihan')
                    ->nullable(),

                TextInput::make('jumlah_dapil')
                    ->label('Jumlah Dapil')
                    ->default(0)
                    ->integer(),

                TextInput::make('jumlah_kursi')
                    ->label('Jumlah Kursi')
                    ->default(0)
                    ->integer(),

                TextInput::make('deskripsi'),

                ToggleButton::make('status_pemilihan')
                    ->label('Apakah Pemilihan Aktif/Non Aktif')
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
                TextColumn::make('nama_institusi')
                    ->label('Nama Institusi')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tingkat_pemilihan')
                    ->label('Tingkat Pemilihan')
                    ->alignCenter()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('jumlah_dapil')
                    ->label('Jumlah Dapil')
                    ->alignCenter()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('jumlah_kursi')
                    ->label('Jumlah Kursi')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->alignCenter()
                    ->toggleable(),

                TextColumn::make('deskripsi')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('status_pemilihan')
                    ->label('Status Aktif')
                    ->alignCenter()
                    ->boolean(),
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
            'index' => Pages\ManageJenisPemilihans::route('/'),
        ];
    }
}
