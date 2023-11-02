<?php

declare(strict_types=1);

namespace Domain\Mail\DataTransferObjects;

use Domain\Shared\ValueObjects\Percent;
use Spatie\LaravelData\Data;

final class PerformanceData extends Data
{
    public function __construct(
        public readonly int $total,
        public readonly Percent $open_rate,
        public readonly Percent $click_rate,
    ) {
    }
}
