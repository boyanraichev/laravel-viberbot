<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;

class FailedEvent extends Event implements EventInterface
{
    public $event = 'failed';

    public $user_id;

    public $description;

    public function __construct($timestamp, $message_token, $user_id, $description)
    {
        parent::__construct($timestamp, $message_token);

        $this->user_id = $user_id;
        $this->description = $description;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
}
