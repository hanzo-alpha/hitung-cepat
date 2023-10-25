<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisPemilihanResource\Pages;
use App\Models\JenisPemilihan;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Wallo\FilamentSelectify\Components\ToggleButton;

class JenisPemilihanResource extends Resource
{
    protected static ?string $model = JenisPemilihan::class;

//    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
                    ->label('Status')
                    ->offColor('danger')
                    ->onColor('primary')
                    ->offLabel('Non Aktif')
                    ->onLabel('Aktif')
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
                    ->toggleable()
                    ->toggledHiddenByDefault(),
                Tables\Columns\ToggleColumn::make('status_pemilihan')
                    ->label('Status Aktif')
                    ->alignCenter(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status_pemilihan')
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
                ]),
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
                                $record->status_pemilihan
                                    ? $record->update(['status_pemilihan' => false])
                                    : $record->update(['status_pemilihan' => true]);
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
            'index' => Pages\ManageJenisPemilihans::route('/'),
        ];
    }
}
