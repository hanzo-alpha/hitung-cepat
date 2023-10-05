<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DapilResource\Pages;
use App\Models\Dapil;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use KodePandai\Indonesia\Models\Province;

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
                Forms\Components\Section::make()->schema([
                    Select::make('provinsi')
                        ->required()
                        ->preload()
                        ->optionsLimit(20)
                        ->lazy()
                        ->options(
                            Province::all()
                                ->pluck('name', 'code')
                        )
                        ->searchable(),
                    Forms\Components\TextInput::make('nama_dapil')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('jumlah_dapil')
                        ->numeric()
                        ->default(0),
                    Forms\Components\TextInput::make('jumlah_kursi')
                        ->numeric()
                        ->default(0),
                ])->inlineLabel()->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->defaultSort('nama_dapil', 'asc')
            ->groups([
                Tables\Grouping\Group::make('prov.name')
                    ->label('Provinsi')
                    ->collapsible()
                    ->titlePrefixedWithLabel(false),
            ])
//            ->groupsInDropdownOnDesktop()
            ->deferLoading()
            ->columns([
                Tables\Columns\TextColumn::make('prov.name')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_dapil')
                    ->label('Nama Dapil')
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
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
                Tables\Filters\SelectFilter::make('provinsi')
                    ->preload()
                    ->optionsLimit(20)
                    ->searchable()
                    ->relationship('prov', 'name'),
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
            'index' => Pages\ManageDapils::route('/'),
        ];
    }
}
