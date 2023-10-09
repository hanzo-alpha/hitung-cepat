<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusDaftarPemilih: string implements HasColor, HasIcon, HasLabel
{
    case Tetap = 'Pemilih Tetap';
    case Sementara = 'Pemilih Sementara';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Tetap => 'Pemilih Tetap',
            self::Sementara => 'Pemilih Sementara',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Tetap => 'primary',
            self::Sementara => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Tetap => 'heroicon-m-pencil',
            self::Sementara => 'heroicon-m-eye',
        };
    }
}
