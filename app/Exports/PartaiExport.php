<?php

declare(strict_types=1);

namespace App\Exports;

use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class PartaiExport extends ExcelExport
{
    public function setUp(): void
    {
        $this->askForFilename()
            ->withFilename(fn ($filename) => date('YmdHis') . '-' . $filename)
            ->withColumns([
                Column::make('no_urut')->heading('No. Urut Partai'),
                Column::make('nama_partai')->heading('Nama Partai'),
                Column::make('alias')->heading('Nama Pendek Partai'),
                Column::make('warna')->heading('Warna Partai'),
            ]);
    }
}
