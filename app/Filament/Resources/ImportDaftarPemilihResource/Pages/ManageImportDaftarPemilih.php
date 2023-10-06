<?php

namespace App\Filament\Resources\ImportDaftarPemilihResource\Pages;

use App\Filament\Resources\ImportDaftarPemilihResource;
use App\Imports\ImportDaftarPemilih;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Maatwebsite\Excel\Facades\Excel;

class ManageImportDaftarPemilih extends ManageRecords
{
    protected static string $resource = ImportDaftarPemilihResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Import')
                ->icon('heroicon-o-arrow-down-tray')
                ->modalSubmitActionLabel('Import')
                ->createAnother(false)
                ->after(function (array $data) {
                    $import = Excel::import(new ImportDaftarPemilih, $data['attachment'], 'public');
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
