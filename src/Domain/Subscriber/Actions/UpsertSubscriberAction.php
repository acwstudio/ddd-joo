<?php

declare(strict_types=1);

namespace Domain\Subscriber\Actions;

//use Domain\Automation\Events\SubscribedToFormEvent;
use Domain\Shared\Models\User;
use Domain\Subscriber\DataTransferObjects\SubscriberData;
use Domain\Subscriber\Models\Subscriber;

final class UpsertSubscriberAction
{
    public static function execute(SubscriberData $data, User $user): Subscriber
    {
        $subscriber = Subscriber::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                ...$data->all(),
                'form_id' => $data->form?->id,
                'user_id' => $user->id,
            ],
        );

        $subscriber->tags()->sync($data->tags->toCollection()->pluck('id'));

        // Only fires automations if it's a new subscriber
        if ($data->form && ! $data->id) {
//            event(new SubscribedToFormEvent($subscriber, $user));
        }

        return $subscriber->load('tags', 'form');
    }
}
