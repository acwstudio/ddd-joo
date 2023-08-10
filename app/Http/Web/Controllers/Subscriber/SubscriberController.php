<?php

declare(strict_types=1);

namespace App\Http\Web\Controllers\Subscriber;

use Domain\Subscriber\ViewModels\GetSubscribersViewModel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class SubscriberController
{
    public function index(Request $request): Response
    {
        return Inertia::render('Subscriber/List', [
            'model' => new GetSubscribersViewModel($request->get('page', 1)),
        ]);
    }
}
