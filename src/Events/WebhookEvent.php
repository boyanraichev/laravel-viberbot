<?php
namespace Boyo\Viberbot\Events;

use Illuminate\Http\Request;

class WebhookEvent extends Event
{
    protected $event = 'webhook';

    public function __construct(Request $request)
    {
        parent::__construct($request->timestamp, $request->message_token);
    }

}
