<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Boyo\Viberbot\Interfaces\ViberUser;
use Illuminate\Http\Request;

class MessageEvent extends Event implements EventInterface
{
    protected $event = 'message';

    public $user;

    public $message;

    // TODO: Assign right Message object and check is it working
    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);

        $this->user = $user;
        $this->message = $message;
    }

    public function getUserId()
    {
        return $this->user->viber_id;
    }
    
}
