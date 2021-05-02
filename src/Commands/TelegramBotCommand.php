<?php

namespace CCUFFS\TelegramBot\Commands;

use Illuminate\Console\Command;

class TelegramBotCommand extends Command
{
    public $signature = 'laravel-telegram-bot';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
