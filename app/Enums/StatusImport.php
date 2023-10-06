<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusImport: int implements HasColor, HasIcon, HasLabel
{
    case Sukses = 1;
    case Pending = 2;
    case Gagal = 0;

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Sukses => 'success',
            self::Gagal => 'danger',
            self::Pending => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Sukses => 'heroicon-m-check-badge',
            self::Gagal => 'heroicon-m-eye-slash',
            self::Pending => 'heroicon-m-exclamation-circle',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Sukses => 'SUKSES',
            self::Gagal => 'GAGAL',
            self::Pending => 'PENDING',
        };
    }
}
