<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalegResource\Pages;
use App\Models\Caleg;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Wallo\FilamentSelectify\Components\ToggleButton;

class CalegResource extends Resource
{
    protected static ?string $model = Caleg::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $slug = 'caleg';

    protected static ?string $label = 'Calon Kandidat';

    protected static ?string $pluralLabel = 'Calon Kandidat';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
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

                    TextInput::make('nama_caleg')
                        ->label('Nama Caleg')
                        ->required(),

                    Select::make('jenis_calon_id')
                        ->required()
                        ->default(1)
                        ->relationship('jenis_calon', 'jenis_calon'),

                    //                    Forms\Components\TextInput::make('status_caleg')
                    //                        ->nullable()
                    //                        ->default('Terdaftar')
                    //                        ->maxLength(255),
                    //
                    ToggleButton::make('status_aktif')
                        ->label('Apakah Caleg Aktif/Non Aktif')
                        ->offColor('danger')
                        ->onColor('primary')
                        ->offLabel('Tidak')
                        ->onLabel('Ya')
                        ->default(true),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('nama_caleg')
                    ->label('Nama Calon Legislatif')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('partai.nama_partai')
                    ->label('Partai')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_calon.jenis_calon')
                    ->label('Pemilihan')
                    ->toggleable()
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_suara')
                    ->alignCenter()
                    ->toggleable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_caleg')
                    ->label('Status Caleg')
                    ->alignCenter()
                    ->badge()
                    ->toggleable()
                    ->color('success')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status_aktif')
                    ->label('Status')
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
            'index' => Pages\ManageCalegs::route('/'),
        ];
    }
}
