<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImportDaftarPemilihResource\Pages;
use App\Models\ImportDaftarPemilih;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ImportDaftarPemilihResource extends Resource
{
    protected static ?string $model = ImportDaftarPemilih::class;

    //    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $slug = 'import-daftar-pemilih';

    protected static ?string $label = 'Import DPT';

    protected static ?string $pluralLabel = 'Import DPT';

    protected static ?string $navigationGroup = 'Tools';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('attachment')
                    ->hiddenLabel()
                    ->preserveFilenames()
                    ->previewable(false)
                    ->acceptedFileTypes([
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'text/csv',
                    ])
                    ->maxSize('2048')
                    ->maxFiles(1)
                    ->columnSpanFull()
                    ->directory('imports'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provinsi')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_kecamatan')
                    ->label('Jumlah Kec.')
                    ->toggleable()
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_kelurahan')
                    ->label('Jumlah Kel.')
                    ->toggleable()
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_tps')
                    ->label('Jumlah TPS')
                    ->toggleable()
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_laki')
                    ->label('Laki')
                    ->toggleable()
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_perempuan')
                    ->label('Perempuan')
                    ->toggleable()
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_pemilih')
                    ->label('Total L+P')
                    ->toggleable()
                    ->alignCenter()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status_import')
                    ->label('Status')
                    ->toggleable()
                    ->alignCenter()
                    ->sortable()
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
            'index' => Pages\ManageImportDaftarPemilih::route('/'),
        ];
    }
}
