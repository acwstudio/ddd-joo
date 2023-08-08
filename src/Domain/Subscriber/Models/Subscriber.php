<?php

declare(strict_types=1);

namespace Domain\Subscriber\Models;

use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\Concerns\HasUser;
use Domain\Subscriber\Builders\SubscriberBuilder;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Illuminate\Notifications\Notifiable;
use Spatie\LaravelData\WithData;

final class Subscriber extends BaseModel
{
    use Notifiable;
    use WithData;
    use HasUser;

    protected $dataClass = SubscriberData::class;

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'form_id',
        'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function newEloquentBuilder($query): SubscriberBuilder
    {
        return new SubscriberBuilder($query);
    }
}
