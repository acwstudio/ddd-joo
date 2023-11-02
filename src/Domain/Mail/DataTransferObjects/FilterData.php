<?php

declare(strict_types=1);

namespace Domain\Mail\DataTransferObjects;

use Spatie\LaravelData\Data;

final class FilterData extends Data
{
    public function __construct(
        public readonly array $form_ids = [],
        public readonly array $tag_ids = [],
    ) {
    }
}
