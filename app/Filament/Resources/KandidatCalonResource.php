<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KandidatCalonResource\Pages;
use App\Models\KandidatCalon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Wallo\FilamentSelectify\Components\ToggleButton;

class KandidatCalonResource extends Resource
{
    protected static ?string $model = KandidatCalon::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $slug = 'kandidat-calon';

    protected static ?string $label = 'Kandidat Calon';

    protected static ?string $pluralLabel = 'Kandidat Calon';

    protected static ?string $navigationLabel = 'Kandidat Calon';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $recordTitleAttribute = 'id';

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

                    TextInput::make('nama_kandidat_1')
                        ->label('Nama Pasangan Calon')
                        ->required(),

                    TextInput::make('nama_kandidat_2')
                        ->label('Nama Pasangan Calon Wakil')
                        ->required(),

                    Select::make('jenis_calon_id')
                        ->required()
                        ->relationship('jenis_calon', 'jenis_calon'),

                    ToggleButton::make('status_kandidat')
                        ->label('Apakah Kandidat Aktif/Non Aktif')
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
                TextColumn::make('partai.alias')
                    ->label('Partai')
                    ->badge()
                    ->color('primary')
                    ->default('TDP')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_kandidat_1')
                    ->label('Nama Kandidat Calon')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_kandidat_2')
                    ->label('Nama Kandidat Calon Wakil')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis_calon.jenis_calon')
                    ->label('Jenis Calon')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status_kandidat')
                    ->badge()
                    ->alignCenter()
                    ->formatStateUsing(fn ($record) => $record->status_kandidat ? 'Aktif' : 'Non Aktif')
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '0' => 'danger',
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])->label('Aksi'),
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
            'index' => Pages\ManageKandidatCalons::route('/'),
        ];
    }
}
