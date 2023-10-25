<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenggunaResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use RalphJSmit\Filament\Components\Forms\Sidebar;
use Wallo\FilamentSelectify\Components\ToggleButton;

class PenggunaResource extends Resource
{
    protected static ?string $model = User::class;

//    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $label = 'Pengguna';

    protected static ?string $slug = 'pengguna';

    protected static ?string $pluralLabel = 'Pengguna';

    protected static ?string $navigationLabel = 'Pengguna';

    protected static ?string $navigationGroup = 'Tools';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Sidebar::make([
                    Section::make()
                        ->schema([
                            TextInput::make('name')
                                ->label('Nama Pengguna')
                                ->required(),

                            TextInput::make('email')
                                ->label('Surel')
                                ->required(),

                            TextInput::make('password')
                                ->label('Kata Sandi')
                                ->required(),

                            Select::make('roles')
                                ->label('Peran')
                                ->relationship('roles', 'name')
                                ->default(2)
                                ->multiple()
                                ->preload()
                                ->lazy()
                                ->searchable(),
                            // ...
                        ]),
                    // ...
                ], [
                    Section::make()
                        ->schema([
                            ToggleButton::make('is_admin')
                                ->label('Status Admin')
                                ->default(false)
                                ->onColor('primary')
                                ->offColor('danger'),

                            ToggleButton::make('is_active')
                                ->label('Status Aktif')
                                ->default(true)
                                ->onColor('primary')
                                ->offColor('danger'),
                            // ...
                        ]),
                    // ...
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email_verified_at')
                    ->label('Email Terverifikasi')
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->date(config('custom.date.display_long')),

                TextColumn::make('roles.name')
                    ->label('Peran')
                    ->listWithLineBreaks()
                    ->badge()
                    ->color(fn ($state): string => $state === 'super_admin' ? 'warning' : 'success')
                    ->formatStateUsing(fn (string $state): string => \Str::replace('_', ' ', \Str::upper($state)))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Admin')
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->toggleable()
                    ->alignCenter()
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('roles')
                    ->label('Peran')
                    ->searchable()
                    ->preload()
                    ->relationship('roles', 'name'),
                Tables\Filters\TernaryFilter::make('is_admin')->label('Admin'),
                Tables\Filters\TernaryFilter::make('is_active')->label('Aktif'),
            ], Tables\Enums\FiltersLayout::AboveContent)
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
                            ->withFilename(fn ($filename) => date('YmdHis') . '-' . $filename)
                            ->withColumns([
                                Column::make('id')->heading('NO.'),
                                Column::make('name')->heading('NAMA'),
                                Column::make('email')->heading('EMAIL'),
                            ]),
                    ]),

                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePenggunas::route('/'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }
}
