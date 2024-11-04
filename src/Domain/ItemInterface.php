<?php

declare(strict_types=1);

namespace App\Domain;

interface ItemInterface
{
    const MIN_QUALITY = 0;

    public function updateQuality(): void;
}
