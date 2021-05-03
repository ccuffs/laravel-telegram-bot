<?php

namespace CCUFFS\TelegramBot\Commands;

use Illuminate\Console\Command;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

class TelegramBotSetupCommand extends Command
{
    public $signature = 'bot:telegram-setup';

    public $description = "Setup the Telegram bot to use Telegram's API";

    protected function getWebhookUrl() {
        $hookUrl = config('telegrambot.webhook_url', '');
        
        if(empty($hookUrl)) {
            $hookUrl = config('app.url') . '/' . config('telegrambot.webhook_route');
        } 
        
        return $hookUrl;
    }

    protected function assertConfigsAreOk() {
        $apiKey = config('telegrambot.api_key', '');
        $botUsername = config('telegrambot.bot_username', '');
        $hookUrl = $this->getWebhookUrl();
        
        if(empty($apiKey)) {
            $this->error('Problem: empty entry "api_key" in "config/telegrambot.php" file.');
            exit(1);
        }

        if(empty($botUsername)) {
            $this->error('Problem: empty entry "bot_username" in "config/telegrambot.php" file.');
            exit(1);
        }

        if(empty($hookUrl)) {
            $this->error('Problem: empty webhook url');
            exit(1);
        }              
    }

    protected function setWebhook() {
        $apiKey = config('telegrambot.api_key');
        $botUsername = config('telegrambot.bot_username');
        $hookUrl = $this->getWebhookUrl();

        try {
            $telegram = new Telegram($apiKey, $botUsername);
            
            $this->comment('Setting webhook: "$hookUrl"');
            $result = $telegram->setWebhook($hookUrl);

            if ($result->isOk()) {
                $this->comment('All good!');
                $this->comment($result->getDescription());
            } else {
                $this->info('Something wrong happened. Check your webhook URL.');
            }
        } catch (TelegramException $e) {
            $this->error('Failed: ' . $e->getMessage());
            exit(2);
        }
    }

    protected function unsetWebhook() {
        $apiKey = config('telegrambot.api_key', '');
        $botUsername = config('telegrambot.bot_username', '');

        try {
            $telegram = new Telegram($apiKey, $botUsername);
            $result = $telegram->deleteWebhook();

            $this->comment($result->getDescription());
            
        } catch (TelegramException $e) {
            $this->error('Failed: ' . $e->getMessage());
            exit(3);
        }
    }    

    public function handle()
    {
        $this->assertConfigsAreOk();
        $this->setWebhook();
    }
}
