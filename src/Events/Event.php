<?php
namespace Boyo\Viberbot\Events;

class Event
{
    protected $event = '';

    protected $timestamp;

    protected $message_token;

    public function __construct($timestamp, $message_token)
    {
        $this->timestamp = $timestamp;
        $this->message_token = $message_token;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getMessageToken()
    {
        return $this->message_token;
    }
    
    public function toArray()
    {
	    $array = get_object_vars($this);
	    
	    $array['event'] = $this->event;
	    $array['timestamp'] = $this->timestamp;
	    $array['message_token'] = $this->message_token;
	    
	    return $array;
    }
}
