<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusSuara: string implements HasColor, HasIcon, HasLabel
{
    public const SUARA_SAH = 'Suara Sah';

    public const SUARA_TIDAK_SAH = 'Suara Tidak Sah';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SUARA_SAH => 'Suara Sah',
            self::SUARA_TIDAK_SAH => 'Suara Tidak Sah',
            default => '',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::SUARA_SAH => 'success',
            self::SUARA_TIDAK_SAH => 'danger',
            default => '',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SUARA_SAH => 'heroicon-m-check-badge',
            self::SUARA_TIDAK_SAH => 'heroicon-m-eye-slash',
            default => '',
        };
    }
}
