<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusAktif: int implements HasColor, HasIcon, HasLabel
{
    case Aktif = 1;
    case NonAktif = 0;

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Aktif => 'success',
            self::NonAktif => 'danger'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Aktif => 'heroicon-m-check-badge',
            self::NonAktif => 'heroicon-m-eye-slash'
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Aktif => 'AKTIF',
            self::NonAktif => 'NON AKTIF'
        };
    }
}
