<?php

declare(strict_types=1);

namespace Domain\Mail\Models\Casts;

use Domain\Mail\DataTransferObjects\FilterData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Spatie\LaravelData\DataCollection;

final class FiltersCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): FilterData
    {
        $filterArray = json_decode($value, true);

        return $filterArray
            ? FilterData::from($filterArray)
            : FilterData::from(FilterData::empty());
    }

    /**
     * @param  DataCollection  $value
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return [
            'filters' => json_encode($value),
        ];
    }
}
