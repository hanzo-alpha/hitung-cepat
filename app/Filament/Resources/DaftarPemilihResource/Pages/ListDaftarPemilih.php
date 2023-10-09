<?php

namespace App\Filament\Resources\DaftarPemilihResource\Pages;

use App\Filament\Resources\DaftarPemilihResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDaftarPemilih extends ListRecords
{
    protected static string $resource = DaftarPemilihResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            //            Actions\Action::make('import')
            //                ->label('Import DPT')
            //                ->icon('heroicon-o-arrow-up-on-square')
            //                ->color('success')
            //                ->form([
            //                    FileUpload::make('attachment')
            //                        ->hiddenLabel()
            //                        ->preserveFilenames()
            //                        ->getUploadedFileNameForStorageUsing(
            //                            fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
            //                                ->prepend(now()->format('Ymd') . '-'),
            //                        )
            //                        ->previewable(false)
            //                        ->acceptedFileTypes([
            //                            'application/vnd.ms-excel',
            //                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            //                            'text/csv',
            //                        ])
            //                        ->maxSize('2048')
            //                        ->maxFiles(1)
            //                        ->directory('imports'),
            //
            //                ])
            //                ->action(function (Get $get, Component $component) {
            //                    dd($get, $component);
            //                })
            //                ->modalSubmitActionLabel('Import')
            //                ->modalDescription('Silahkan download terlebih dahulu file template, mengisinya dan import disini'),
        ];
    }
}
