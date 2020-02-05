<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Boyo\Viberbot\Interfaces\ViberUser;

class ConversationStartedEvent extends Event implements EventInterface
{
    public $event = 'conversation_started';

    public $user;

    public $type;

    public $context;

    public $subscribed;

    public function __construct($timestamp, $message_token, ViberUser $user, $type, $context, $subscribed)
    {
        parent::__construct($timestamp, $message_token);

        $this->user = $user;
        $this->type = $type;
        $this->context = $context;
        $this->subscribed = $subscribed;
    }

    public function getUserId()
    {
        return $this->user->viber_id;
    }
    
}
