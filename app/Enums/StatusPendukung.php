<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusPendukung: string implements HasColor, HasIcon, HasLabel
{
    case Valid = 'Valid';
    case Potensial = 'Potensial';
    case Bawaan = 'Bawaan';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Valid => 'Pendukung Valid',
            self::Potensial => 'Pendukung Potensial',
            self::Bawaan => 'Pendukung Bawaan',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Valid => 'primary',
            self::Potensial => 'danger',
            self::Bawaan => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Valid => 'heroicon-m-check-badge',
            self::Potensial => 'heroicon-m-light-bulb',
            self::Bawaan => 'heroicon-m-lifebuoy',
        };
    }
}
