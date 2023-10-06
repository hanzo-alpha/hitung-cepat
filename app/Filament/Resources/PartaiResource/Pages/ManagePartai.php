<?php

namespace App\Filament\Resources\PartaiResource\Pages;

use App\Filament\Resources\PartaiResource;
use App\Imports\ImportPartai;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Maatwebsite\Excel\Facades\Excel;

class ManagePartai extends ManageRecords
{
    protected static string $resource = PartaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-o-plus')
                ->successNotificationTitle('Partai berhasil ditambahkan'),

            Actions\Action::make('import')
                ->label('Import')
                ->icon('heroicon-o-arrow-up-on-square')
                ->modalSubmitActionLabel('Import')
                ->form([
                    FileUpload::make('attachment')
                        ->hiddenLabel()
                        ->preserveFilenames()
                        ->previewable(false)
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'text/csv',
                        ])
                        ->maxSize('2048')
                        ->maxFiles(1)
                        ->columnSpanFull()
                        ->directory('imports'),
                ])
                ->after(function (array $data) {
                    $import = Excel::import(new ImportPartai, $data['attachment'], 'public');
                    if ($import) {
                        Notification::make()
                            ->title('Data Berhasil di Import')
                            ->success()
                            ->sendToDatabase(auth()->user());
                    }
                }),
        ];
    }
}
