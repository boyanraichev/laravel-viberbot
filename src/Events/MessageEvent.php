<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Boyo\Viberbot\Interfaces\ViberUser;
use Illuminate\Http\Request;

class MessageEvent extends Event implements EventInterface
{
    protected $event = 'message';

    public $sender;

    public $message;

    // TODO: Assign right Message object and check is it working
    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);

        $this->sender = $request->sender;
        $this->message = $request->message;
    }

    public function getUserId()
    {
        return $this->sender->id;
    }
    
}
