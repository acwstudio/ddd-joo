<?php

declare(strict_types=1);

namespace Domain\Subscriber\Actions;

use Domain\Subscriber\Models\Subscriber;

final class DeleteSubscriberAction
{
    public static function execute(Subscriber $subscriber): void
    {
        $subscriber->delete();
    }
}
