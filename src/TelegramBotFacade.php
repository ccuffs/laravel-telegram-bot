<?php

namespace CCUFFS\TelegramBot;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ccuffs\TelegramBot\TelegramBot
 */
class TelegramBotFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-telegram-bot';
    }
}
