<?php

declare(strict_types=1);

namespace Domain\Shared\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

final class UserScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = request()->user();

        if ($user) {
            $builder->whereBelongsTo($user);
        }
    }
}
