<?php

declare(strict_types=1);

namespace Domain\Subscriber\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;

final class TagFilter extends Filter
{
    public function handle(Builder $subscribers, Closure $next): Builder
    {
        if (count($this->ids) === 0) {
            return $next($subscribers);
        }

        $subscribers->whereHas('tags', fn (Builder $tags) => $tags->whereIn('id', $this->ids)
        );

        return $next($subscribers);
    }
}
