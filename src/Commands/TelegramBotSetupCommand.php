<?php

namespace CCUFFS\TelegramBot\Commands;

use CCUFFS\TelegramBot\TelegramBot;
use Illuminate\Console\Command;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

class TelegramBotSetupCommand extends Command
{
    public $signature = 'bot:telegram-setup';

    public $description = "Setup the Telegram bot to use Telegram's API";

    protected function assertConfigsAreOk() {
        $bot = new TelegramBot();

        $apiKey = config('telegrambot.api_key', '');
        $botUsername = config('telegrambot.bot_username', '');
        $hookUrl = $bot->getWebhookUrl();
        
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

    protected function setup() {
        try {
            $bot = new TelegramBot();
            $hookUrl = $bot->getWebhookUrl();
            $botUsername = config('telegrambot.bot_username', '');            

            $this->line('Setting up Telegram API');
            $this->line("  Your webhook URL: <fg=yellow>$hookUrl</>");
            $this->line("  Your bot username: <fg=yellow>$botUsername</>");

            $result = $bot->setupTelegraApi();

            if ($result->isOk()) {
                $this->info('Operation completed!');
            }
            $this->line('Telegram API responde: <fg=yellow>' . $result->getDescription() . '</>');

        } catch (TelegramException $e) {
            $this->error('Failed: ' . $e->getMessage());
            exit(2);
        }
    }

    protected function undoSetup() {
        try {
            $bot = new TelegramBot();
            
            $this->line('Undoing Telegram API setup');

            $result = $bot->resetTelegraApiSetup();

            $this->info('Setup with Telegram API cleared.');
            $this->line('Telegram API responde: <fg=yellow>' . $result->getDescription() . '</>');

        } catch (TelegramException $e) {
            $this->error('Failed: ' . $e->getMessage());
            exit(3);
        }
    }    

    public function handle()
    {
        $this->assertConfigsAreOk();
        $this->setup();
    }
}
