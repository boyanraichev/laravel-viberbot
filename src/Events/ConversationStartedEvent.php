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

	/*
	{
	   "event":"conversation_started",
	   "timestamp":1457764197627,
	   "message_token":4912661846655238145,
	   "type":"open",
	   "context":"context information",
	   "user":{
	      "id":"01234567890A=",
	      "name":"John McClane",
	      "avatar":"http://avatar.example.com",
	      "country":"UK",
	      "language":"en",
	      "api_version":1
	   },
	   "subscribed":false
	}
	*/

    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);

        $this->user = $user;
        $this->type = $type;
        $this->context = $context;
        $this->subscribed = $subscribed;
    }

    public function getUserId()
    {
        return $this->user->id;
    }
    
    
}
