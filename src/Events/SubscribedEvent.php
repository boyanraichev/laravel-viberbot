<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Boyo\Viberbot\Interfaces\ViberUser;
use Illuminate\Http\Request;

class SubscribedEvent extends Event implements EventInterface
{
    protected $event = 'subscribed';

    public $user;

    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);

        $this->user = $request->user;
    }

    public function getUserId()
    {
        return $this->user['id'];
    }
}
