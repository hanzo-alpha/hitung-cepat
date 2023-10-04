<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DapilResource\Pages;
use App\Models\Dapil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DapilResource extends Resource
{
    protected static ?string $model = Dapil::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $slug = 'dapil';

    protected static ?string $label = 'Dapil';

    protected static ?string $pluralLabel = 'Dapil';

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $recordTitleAttribute = 'nama_dapil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('provinsi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kabupaten')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kecamatan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('kelurahan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_dapil')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jumlah_dapil')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('jumlah_kursi')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provinsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_dapil')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jumlah_dapil')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_kursi')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageDapils::route('/'),
        ];
    }
}
