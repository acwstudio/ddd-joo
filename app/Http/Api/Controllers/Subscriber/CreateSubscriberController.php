<?php

declare(strict_types=1);

namespace App\Http\Api\Controllers\Subscriber;

use Domain\Subscriber\Actions\UpsertSubscriberAction;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Illuminate\Http\Request;
use Spatie\LaravelData\Contracts\DataObject;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

final class CreateSubscriberController
{
    /**
     * @throws InvalidDataClass
     */
    public function __invoke(SubscriberData $data, Request $request): DataObject
    {
        $subscriber = UpsertSubscriberAction::execute($data, $request->user());

        return $subscriber->getData();
    }
}
