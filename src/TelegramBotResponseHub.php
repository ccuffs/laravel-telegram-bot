<?php

namespace CCUFFS\TelegramBot;

use CCUFFS\TelegramBot\Events\PayloadReceived;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Illuminate\Support\Facades\Log;

class TelegramBotResponseHub
{
    protected function processIncomingCmd(SystemCommand $cmd) {
        $message = $cmd->getMessage();
        return $cmd->replyToChat("Hi, sup?");
    }

    public function handle(SystemCommand $cmd): ServerResponse {
        try {
            // Inform all listeners that a payload has arrived
            event(new PayloadReceived($cmd));

            $result = $this->processIncomingCmd($cmd);
            
            if($result) {
                return $result;
            }
            
            // If we got here, we have no action to reply...
            return Request::emptyResponse();

        } catch(\Exception $e) {
            Log::error($e);

            // TODO: add config to allow reploy of errors
            return $cmd->replyToChat("💀 Error: " . $e->getMessage() . "\n" . '`'.$e->getTraceAsString().'`',
                                ['parse_mode' => 'markdown']);
        }
    }
}
