<?php

//use App\Http\Api\Controllers\Mail\ClickSentMailController;
//use App\Http\Api\Controllers\Mail\OpenSentMailController;
use App\Http\Api\Controllers\Subscriber\CreateSubscriberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function () {
    Route::post('/tokens/create', function (Request $request) {
        Auth::attempt(['email' => 'demo@mailtool.biz', 'password' => 'password'], true);
//        dd($request->user());
        $token = $request->user()->createToken('ddd');

        return ['token' => $token->plainTextToken];
    });
});

Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::post('subscribers', CreateSubscriberController::class);
//    Route::patch('sent-mails/{sentMail}/open', OpenSentMailController::class);
//    Route::patch('sent-mails/{sentMail}/click', ClickSentMailController::class);
});
