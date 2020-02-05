<?php
namespace Boyo\Viberbot\Events;

class WebhookEvent extends Event
{
    public $event = 'webhook';

    public function __construct($timestamp, $message_token)
    {
        parent::__construct($timestamp, $message_token);
    }

}
