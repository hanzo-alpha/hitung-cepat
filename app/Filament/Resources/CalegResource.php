<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CalegResource\Pages;
use App\Models\Caleg;
use App\Utilities\Helpers;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Wallo\FilamentSelectify\Components\ToggleButton;

class CalegResource extends Resource
{
    protected static ?string $model = Caleg::class;

    //    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $slug = 'caleg';

    protected static ?string $label = 'Calon Legislatif';

    protected static ?string $pluralLabel = 'Calon Legislatif';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    TextInput::make('nama_caleg')
                        ->label('Nama Caleg')
                        ->autofocus()
                        ->columnSpanFull()
                        ->required(),

                    Select::make('jenis_kelamin')
                        ->label('Jenis Kelamin')
                        ->options(config('custom.status.jenis_kelamin'))
                        ->default(1),

                    Select::make('partai_id')
                        ->label('Partai')
                        ->required()
                        ->lazy()
                        ->preload()
                        ->default(25)
                        ->searchable()
                        ->optionsLimit(10)
                        ->relationship('partai', 'nama_partai'),

                    Select::make('jenis_pemilihan_id')
                        ->required()
                        ->default(1)
                        ->relationship('jenisPemilihan', 'nama_institusi'),

                    ToggleButton::make('status_aktif')
                        ->label('Status Aktif Calon')
                        ->offColor('danger')
                        ->onColor('success')
                        ->offLabel('Non Aktif')
                        ->onLabel('Aktif')
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
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->badge()
                    ->formatStateUsing(fn (int $state): string => Helpers::getNamaJenisKelamin($state))
                    ->icon(fn (int $state): string => match ($state) {
                        1 => 'heroicon-o-user',
                        2 => 'heroicon-o-users',
                    })
                    ->color(fn (int $state): string => match ($state) {
                        1 => 'success',
                        2 => 'primary',
                    }),
                Tables\Columns\TextColumn::make('partai.nama_partai')
                    ->label('Partai')
                    ->alignCenter()
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenisPemilihan.nama_institusi')
                    ->label('Pemilihan')
                    ->toggleable()
                    ->alignCenter()
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status_aktif')
                    ->label('Status Aktif')
                    ->alignCenter(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status_aktif')
                    ->label('Status Aktif')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Non Aktif')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->tooltip('Tindakan'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('status_aktif')
                        ->label('Non Aktifkan yang dipilih')
                        ->icon('heroicon-o-shield-check')
                        ->color('primary')
                        ->action(function (Collection $records) {
                            return $records->each(function ($record) {
                                $record->status_aktif
                                    ? $record->update(['status_aktif' => false])
                                    : $record->update(['status_aktif' => true]);
                            });
                        })->after(function () {
                            Notification::make()
                                ->title('Data yang dipilih berhasil diupdate')
                                ->success()
                                ->send()
                                ->sendToDatabase(auth()->user());
                        })
                        ->deselectRecordsAfterCompletion(),

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
