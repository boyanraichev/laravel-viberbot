<?php
namespace Boyo\Viberbot\Events;

use Boyo\Viberbot\Interfaces\EventInterface;
use Illuminate\Http\Request;

class FailedEvent extends Event implements EventInterface
{
    protected $event = 'failed';

    public $user_id;

    public $description;

    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);

        $this->user_id = $user_id;
        $this->description = $description;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
}
