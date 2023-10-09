<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusSuara: string implements HasColor, HasIcon, HasLabel
{
    case SUARA_SAH = 'SUARA SAH';

    case SUARA_TIDAK_SAH = 'SUARA TIDAK SAH';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SUARA_SAH => 'SUARA SAH',
            self::SUARA_TIDAK_SAH => 'SUARA TIDAK SAH'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::SUARA_SAH => 'success',
            self::SUARA_TIDAK_SAH => 'danger'
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::SUARA_SAH => 'heroicon-m-check-badge',
            self::SUARA_TIDAK_SAH => 'heroicon-m-eye-slash'
        };
    }
}
