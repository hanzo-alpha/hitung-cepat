<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HitungSuaraPartaiResource\Pages;
use App\Models\HitungSuaraPartai;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use RalphJSmit\Filament\Components\Forms\Sidebar;

class HitungSuaraPartaiResource extends Resource
{
    protected static ?string $model = HitungSuaraPartai::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $slug = 'suara-partai';

    protected static ?string $label = 'Suara Partai';

    protected static ?string $pluralLabel = 'Suara Partai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Sidebar::make([
                    Section::make()
                        ->schema([
                            Forms\Components\Select::make('partai_id')
                                ->relationship('partai', 'nama_partai')
                                ->lazy()
                                ->preload()
                                ->optionsLimit(15)
                                ->searchable()
                                ->unique()
                                ->required(),
                            Forms\Components\Select::make('jenis_pemilihan_id')
                                ->label('Jenis Pemilihan')
                                ->relationship('jenisPemilihan', 'nama_institusi')
                                ->lazy()
                                ->preload()
                                ->optionsLimit(15)
                                ->searchable()
                                ->required(),
                        ]),
                    // ...
                ], [
                    Section::make()
                        ->schema([
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
                        ]),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('10s')
            ->emptyStateDescription('Setelah Anda mengisi form pertama Anda, hasilnya akan muncul di sini')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Suara Partai')
                    ->icon('heroicon-o-plus')
                    ->button(),
            ])
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('partai.alias')
                    ->label('Nama Partai')
                    ->description(fn($record): string => $record->partai->nama_partai)
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
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('partai')
                    ->searchable()
                    ->relationship('partai', 'nama_partai')
                    ->preload()
                    ->multiple()
                    ->optionsLimit(15),
            ])
            ->persistFiltersInSession()
            ->filtersFormWidth('xs')
            ->filtersTriggerAction(fn(Tables\Actions\Action $action) => $action->button()->label('Filter'))
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()
                            ->askForFilename()
                            ->withFilename(fn($filename) => date('YmdHis') . '-' . $filename)
                            ->withColumns([
                                Column::make('id')->heading('NO.'),
                                Column::make('partai.nama_partai')->heading('NAMA PARTAI'),
                                Column::make('jenisPemilihan.nama_institusi')->heading('INSTITUSI'),
                                Column::make('jumlah_suara_partai')->heading('JUMLAH SUARA PARTAI'),
                                Column::make('jumlah_dapil')->heading('JUMLAH DAPIL'),
                                Column::make('jumlah_kursi')->heading('JUMLAH KURSI'),
                            ]),
                    ]),
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
