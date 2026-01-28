<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum PostStatus: string implements HasLabel, HasColor
{
    case DRAFT = 'draft';
    case REVIEWING = 'reviewing';
    case PUBLISHED = 'published';
    case REJECTED = 'rejected';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DRAFT => 'Draft (Konsep)',
            self::REVIEWING => 'Menunggu Review',
            self::PUBLISHED => 'Terbit',
            self::REJECTED => 'Ditolak',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::REVIEWING => 'warning', // Kuning
            self::PUBLISHED => 'success', // Hijau
            self::REJECTED => 'danger',   // Merah
        };
    }
}