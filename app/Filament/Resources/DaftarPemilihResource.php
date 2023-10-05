<?php

namespace App\Filament\Resources;

use App\Enums\StatusAktif;
use App\Enums\StatusDaftarPemilih;
use App\Filament\Resources\DaftarPemilihResource\Pages;
use App\Models\DaftarPemilih;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use RalphJSmit\Filament\Components\Forms\Sidebar;

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
                Sidebar::make([
                    Section::make()->schema([
                        TextInput::make('nama_lengkap')
                            ->required(),

                        TextInput::make('nik')
                            ->required(),

                        TextInput::make('no_kk')
                            ->required(),

                        TextInput::make('notelp')
                            ->required(),

                        Select::make('status_daftar')
                            ->label('Status Aktif')
                            ->default(StatusAktif::NonAktif)
                            ->options(StatusAktif::class),

                        Select::make('status_pemilih')
                            ->label('Status Pemilih')
                            ->default(StatusDaftarPemilih::Sementara)
                            ->options(StatusDaftarPemilih::class),

                        TextInput::make('alamat'),
                    ]),
                ], [
                    Section::make()->schema([

                        TextInput::make('provinsi'),

                        TextInput::make('kabupaten'),

                        TextInput::make('kecamatan'),

                        TextInput::make('kelurahan'),

                        TextInput::make('kode_pos'),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_lengkap'),

                TextColumn::make('nik'),

                TextColumn::make('no_kk'),

                TextColumn::make('alamat'),

                TextColumn::make('provinsi'),

                TextColumn::make('kabupaten'),

                TextColumn::make('kecamatan'),

                TextColumn::make('kelurahan'),

                TextColumn::make('kode_pos'),

                TextColumn::make('status_pemilih'),

                TextColumn::make('notelp'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListDaftarPemilihs::route('/'),
            'create' => Pages\CreateDaftarPemilih::route('/create'),
            'edit' => Pages\EditDaftarPemilih::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_lengkap', 'nik', 'no_kk'];
    }
}
