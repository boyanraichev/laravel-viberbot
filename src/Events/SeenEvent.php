<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Illuminate\Http\Request;

class SeenEvent extends Event implements EventInterface
{
    protected $event = 'seen';

    public $user_id;

    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);
        
        $this->user_id = $request->user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
}
