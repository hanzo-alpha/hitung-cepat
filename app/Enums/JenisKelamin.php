<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum JenisKelamin: int implements HasColor, HasIcon, HasLabel
{
    case LAKI = 1;
    case PEREMPUAN = 0;

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::LAKI => 'success',
            self::PEREMPUAN => 'danger'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::LAKI => 'heroicon-m-check-badge',
            self::PEREMPUAN => 'heroicon-m-eye-slash'
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::LAKI => 'Laki-Laki',
            self::PEREMPUAN => 'Perempuan'
        };
    }
}
