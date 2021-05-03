<?php

use CCUFFS\TelegramBot\TelegramBot;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post(config('telegrambot.webhook_route'), function (Request $request) {
    $bot = new TelegramBot();
    $bot->processWebhook($request);
});
