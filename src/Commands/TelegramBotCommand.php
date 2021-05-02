<?php

namespace CCUFFS\TelegramBot\Commands;

use Illuminate\Console\Command;

class TelegramBotCommand extends Command
{
    public $signature = 'bot:telegram';

    public $description = 'My command';

    protected function set() {
        $apiKey = 'your:bot_api_key';
        $botUsername = 'username_bot';
        $hookUrl = 'https://your-domain/path/to/hook.php';
        
        try {
            $telegram = new Longman\TelegramBot\Telegram($apiKey, $botUsername);
            $result = $telegram->setWebhook($hookUrl);

            if ($result->isOk()) {
                echo $result->getDescription();
            }
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            echo $e->getMessage();
        }
    }

    protected function unset() {
        $apiKey = 'your:bot_api_key';
        $botUsername = 'username_bot';

        try {
            $telegram = new Longman\TelegramBot\Telegram($apiKey, $botUsername);
            $result = $telegram->deleteWebhook();

            echo $result->getDescription();
            
        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            echo $e->getMessage();
        }
    }    

    public function handle()
    {
        $this->comment('All done');
    }
}
