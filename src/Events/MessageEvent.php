<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Boyo\Viberbot\Interfaces\ViberUser;

class MessageEvent extends Event implements EventInterface
{
    public $event = 'message';

    public $user;

    public $message;

    // TODO: Assign right Message object and check is it working
    public function __construct($timestamp, $message_token, ViberUser $user, $message)
    {
        parent::__construct($timestamp, $message_token);

        $this->user = $user;
        $this->message = $message;
    }

    public function getUserId()
    {
        return $this->user->viber_id;
    }
}
