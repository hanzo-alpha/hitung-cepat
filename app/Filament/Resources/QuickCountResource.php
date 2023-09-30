<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuickCountResource\Pages;
use App\Models\QuickCount;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuickCountResource extends Resource
{
    protected static ?string $model = QuickCount::class;

    protected static ?string $slug = 'quick-count';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tps_id')
                    ->label('TPS')
                    ->relationship('data_tps', 'nama_tps')
                    ->createOptionForm([
                        TextInput::make('nama_tps')
                            ->label('Nama TPS'),
                        TextInput::make('jumlah_suara')->default(0)->nullable()->numeric(),
                    ])
                    ->searchable()
                    ->preload()
                    ->lazy()
                    ->optionsLimit(10)
                    ->live(true),
                Select::make('caleg_id')
                    ->label('Caleg')
                    ->relationship('caleg', 'nama_caleg')
                    ->createOptionForm([
                        TextInput::make('nama_caleg')->label('Nama Caleg'),
                        Select::make('partai_id')
                            ->label('Partai')
                            ->required()
                            ->lazy()
                            ->preload()
                            ->default(25)
                            ->searchable()
                            ->optionsLimit(10)
                            ->relationship('partai', 'nama_partai')
                            ->columnSpanFull(),
                        Select::make('jenis_calon_id')
                            ->required()
                            ->default(1)
                            ->relationship('jenis_calon', 'jenis_calon'),
                    ])
                    ->preload()
                    ->searchable()
                    ->lazy()
                    ->optionsLimit(10)
                    ->live(true),
                TextInput::make('jumlah_suara')
                    ->numeric()
                    ->default(0),
                TextInput::make('persentase')
                    ->numeric()
                    ->default(0.00),
                Toggle::make('status_suara'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tps.nama_tps')
                    ->label('TPS')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tps.prov.name')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('caleg.nama_caleg')
                    ->label('Nama Calon')
//                    ->formatStateUsing(function ($state, $record) {
//                        $partai = $record->caleg->first;
//                        dd($state, $partai);
//                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('caleg.partai.nama_partai')
                    ->label('Partai')
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
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status_suara')
                    ->label('Status')
                    ->alignCenter()
                    ->toggleable()
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
            'index' => Pages\ManageQuickCounts::route('/'),
        ];
    }
}
