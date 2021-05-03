<?php

namespace CCUFFS\TelegramBot\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class PayloadReceived
{
    use Dispatchable, SerializesModels;

    public $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }
}