<?php

namespace CCUFFS\TelegramBot;

use Longman\TelegramBot\Telegram;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class TelegramBot
{
    public function __contructor() {
    }

    protected function createTelegramInstance() {
        $apiKey = config('telegram-bot.api_key', '');
        $botUsername = config('telegram-bot.bot_username', '');
        $admins = config('telegram-bot.admins', []);

        // Create Telegram API object
        $telegram = new Telegram($apiKey, $botUsername);

        // Enable admin users
        $telegram->enableAdmins($admins);

        // Add commands paths containing your custom commands
        $commandsPath = implode(DIRECTORY_SEPARATOR, [dirname(__FILE__), 'MessageCommands']);
        $telegram->addCommandsPaths([$commandsPath]);

        // Set custom Download and Upload paths
        //$telegram->setDownloadPath($config['paths']['download']);
        //$telegram->setUploadPath($config['paths']['upload']);

        // Requests Limiter (tries to prevent reaching Telegram API limits)
        //$telegram->enableLimiter($config['limiter']);

        return $telegram;
    }

    public function processWebhook(Request $request) {
        try {
            $telegram = $this->createTelegramInstance();
            $telegram->handle();

        } catch (Longman\TelegramBot\Exception\TelegramException $e) {
            // Log telegram errors
            Longman\TelegramBot\TelegramLog::error($e);

            // Uncomment this to output any errors (ONLY FOR DEVELOPMENT!)
            echo $e;
        } catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
            // Uncomment this to output log initialisation errors (ONLY FOR DEVELOPMENT!)
            echo $e;
        }
    }
}
