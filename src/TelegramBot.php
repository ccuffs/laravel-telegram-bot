<?php

namespace CCUFFS\TelegramBot;

use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;
use Longman\TelegramBot\Exception\TelegramException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramBot
{
    public function __contructor() {
    }

    protected function initLogger() {
        TelegramLog::initialize(
            // Main logger that handles all 'debug' and 'error' logs.
            Log::getLogger(),
            // Updates logger for raw updates.
            Log::getLogger()
        );
    }

    protected function createTelegramInstance() {
        $apiKey = config('telegrambot.api_key');
        $botUsername = config('telegrambot.bot_username');
        $admins = config('telegrambot.admins', []);

        $this->initLogger();

        //\Longman\TelegramBot\Request::setClient($guzz_client);
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

    public function setupTelegraApi() {
        $telegram = $this->createTelegramInstance();
        $hookUrl = $this->getWebhookUrl();        
        $result = $telegram->setWebhook($hookUrl);

        return $result;
    }

    public function resetTelegraApiSetup() {
        $telegram = $this->createTelegramInstance();
        $result = $telegram->deleteWebhook();
        
        return $result;
    }    

    public function getWebhookUrl() {
        $hookUrl = config('telegrambot.webhook_url', '');
        
        if(empty($hookUrl)) {
            $hookUrl = config('app.url') . '/' . config('telegrambot.webhook_route');
        } 
        
        return $hookUrl;
    }

    public function processWebhook(Request $request) {
        try {
            $telegram = $this->createTelegramInstance();
            $telegram->handle();

        } catch (TelegramException $e) {
            TelegramLog::error($e);

            // Uncomment this to output any errors (ONLY FOR DEVELOPMENT!)
            echo $e;
        } catch (TelegramLogException $e) {
            // Uncomment this to output log initialisation errors (ONLY FOR DEVELOPMENT!)
            echo $e;
        }
    }
}
