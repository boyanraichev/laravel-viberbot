<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;

class DeliveredEvent extends Event implements EventInterface
{
    public $event = 'delivered';

    public $user_id;

    public function __construct($timestamp, $message_token, $user_id)
    {
        parent::__construct($timestamp, $message_token);
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
}
