<?php

namespace App\Filament\Resources;

use App\Exports\PartaiExport;
use App\Filament\Resources\PartaiResource\Pages;
use App\Models\Partai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PartaiResource extends Resource
{
    protected static ?string $model = Partai::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()->schema([
                    Forms\Components\TextInput::make('nama_partai')
                        ->required()
                        ->label('Nama Partai'),
                    Forms\Components\TextInput::make('alias')
                        ->nullable()
                        ->label('Alias Partai'),
                    Forms\Components\ColorPicker::make('warna')
                        ->nullable()
                        ->default('#d6e65c')
                        ->label('Warna Partai'),
                    //                CuratorPicker::make('logo')
                    //                    ->label('Logo')
                    //                    ->maxSize(2)
                    //                    ->maxWidth(20)
                    //                    ->acceptedFileTypes(['jpg', 'png', 'webp'])
                    //                    ->preserveFilenames(),
                ])->columns(1)->inlineLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->columns([
                //                CuratorColumn::make('logo')->toggleable(),
                //                Tables\Columns\TextColumn::make('no_urut')
                //                    ->label('No. Urut')
                //                    ->toggleable()
                //                    ->alignCenter()
                //                    ->searchable()
                //                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_partai')
                    ->label('Nama Partai')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alias')
                    ->label('Alias')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ColorColumn::make('warna')
                    ->label('Warna Partai')
                    ->copyable()
                    ->toggleable()
                    ->copyMessage('Kode warna disalin')
                    ->alignCenter()
                    ->copyableState(fn (Partai $record): string => $record->warna)
                    ->sortable(),
                Tables\Columns\TextColumn::make('caleg_count')
                    ->label('Total Caleg')
                    ->alignCenter()
                    ->counts('caleg')
                    ->badge()
                    ->color('info'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()->exports([
                        PartaiExport::make(),
                    ]),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePartais::route('/'),
        ];
    }
}
