<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Boyo\Viberbot\Interfaces\ViberUser;

class SubscribedEvent extends Event implements EventInterface
{
    public $event = 'subscribed';

    public $user;

    public function __construct($timestamp, $message_token, ViberUser $user)
    {
        parent::__construct($timestamp, $message_token);

        $this->user = $user;
    }

    public function getUserId()
    {
        return $this->user->viber_id;
    }
}
