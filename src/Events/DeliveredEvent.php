<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Illuminate\Http\Request;

class DeliveredEvent extends Event implements EventInterface
{
    protected $event = 'delivered';

    public $user_id;

    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
}
