<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Boyo\Viberbot\Interfaces\ViberUser;
use Illuminate\Http\Request;

class ConversationStartedEvent extends Event implements EventInterface
{
    protected $event = 'conversation_started';

    public $user;

    public $type;

    public $context;

    public $subscribed;

    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);

        $this->user = $request->user;
        $this->type = $request->type;
        $this->context = $request->context;
        $this->subscribed = $request->subscribed;
    }

    public function getUserId()
    {
        return $this->user['id'];
    }
    
    
}
