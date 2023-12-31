<?php

declare(strict_types=1);

namespace App\Http\Web\Controllers\Subscriber;

use Domain\Subscriber\Jobs\ImportSubscribersJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class ImportSubscribersController
{
    public function __invoke(Request $request): Response
    {
        ImportSubscribersJob::dispatch(
            storage_path('subscribers/subscribers.csv'),
            $request->user(),
        );

        return response('', Response::HTTP_ACCEPTED);
    }
}
