<?php

namespace CCUFFS\TelegramBot;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class TelegramBotResponseHub
{
    protected SystemCommand $sys;
    protected $message;
    protected $sender;    

    public function __contructor() {
    }

    protected function processGenericCommand()
    {
        $user_id = $this->message->getFrom()->getId();
        $command = $this->message->getCommand();
    }

    public function handle(SystemCommand $cmd): ServerResponse {
        try {
            $this->sys = $cmd;
            $this->message = $cmd->getMessage();
            $this->user = $this->message->getFrom();

            // Any of the following methods will return a result if they want to
            // stop the chaining of other methods, otherwise everything will be checked.

            // TODO: process command/text using laravel events
            return $cmd->replyToChat("Hi");
            if($result = $this->processGenericCommand()) { return $result; }
            
            // If we got here, we have no action to reply...
            return Request::emptyResponse();

        } catch(\Exception $e) {
            return $cmd->replyToChat("💀 Error: " . $e->getMessage() . "\n" . '`'.$e->getTraceAsString().'`',
                                ['parse_mode' => 'markdown']);
        }
    }
}
