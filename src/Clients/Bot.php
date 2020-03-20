<?php
namespace Paragraf\ViberBot;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use Boyo\Viberbot\Http\ApiClient;
use Boyo\Viberbot\Events\WebhookEvent;
use Boyo\Viberbot\Events\ConversationStartedEvent;
use Boyo\Viberbot\Events\SubscribedEvent;
use Boyo\Viberbot\Events\UnsubscribedEvent;
use Boyo\Viberbot\Events\MessageEvent;

class Bot
{

    protected $request;
    
    protected $event = false;
    
    protected $match = false;
    
    protected $response = null;
    

protected $text;

protected $replays = [];

protected $body = [];

protected $question;

    
    public function __construct(Request $request)
    {
        $this->request = $request;
        
        if (!empty($this->request->event)) {
	        switch($this->request->event) {
		        case 'webhook':
		        	$this->event = new WebhookEvent($this->request->timestamp, $this->request->message_token);
		        	break;
		        case 'conversation_started':
					$this->event = new ConversationStartedEvent($this->request->timestamp, $this->request->message_token);    
		        	break;
		        case 'subscribed':
		        	$this->event = new SubscribedEvent($this->request->timestamp, $this->request->message_token, $user);
		        	break;
		        case 'unsubscribed':
		        	$this->event = new UnsubscribedEvent($this->request->timestamp, $this->request->message_token, $user);
		        	break;
		        case 'message':
		        	$this->event = new MessageEvent($this->request->timestamp, $this->request->message_token, $user, $this->request->message);
		        	break;   	
	        }
        }
    }
    
    public function on($event)
    {
        $this->match = ($this->event && $this->event->getEvent() === $event);
        
        return $this;
    }
    
    public function do($callback)
    {
	    if ($this->match) { 
		    $callback(func_get_args());
		}
        return $this;
	}
	
	public function keyboard() 
	{
		if ($this->match) { 
			
		}
		return $this;
	}
	    
    public function hears($text)
    {
        if (is_array($text)) {
            foreach ($text as $txt) {
                if ($this->request->message['text'] === $txt) {
                    return $this->hears($txt);
                }
            }
            $this->proceed = false;
        }
        
        if (is_string($text)) {
            /*
             * This represent regex.
             */
            if (startWith('/', $text) && endWith('/', $text)) {
                if (preg_match($text, $this->request->message['text'])) {
                    return $this;
                }
            }
            if ($this->request->message['text'] === $text) {
                $this->text = $text;
                return $this;
            }
            $this->proceed = false;
//          throw Exception;
        }
        return $this;
    }
    
    public function reply($answer, $method = null)
    {
        if (is_array($answer)) {
            $this->replays = $answer;
            return $this;
        }
        if (is_string($answer)) {
            $this->replays[] = $answer;
            return $this;
        }
        if (is_a($answer, Collection::class)) {
            foreach ($answer as $item) {
                if (is_subclass_of($item, Model::class)) {
                    eval('$this->replays[] = $item->'.$method.';');
                }
            }
            return $this;
        }
    }
    
    public function send()
    {
        if ($this->proceed) {
            if (count($this->replays) === 1) {
                ApiClient::call('POST', 'send_message', array_merge($this->body, ['text' => $this->replays[0], 'receiver' => $this->event->getUserId()]));
                $this->replays = [];
                return;
            }
            foreach ($this->replays as $replay) {
                ApiClient::call('POST', 'send_message', array_merge($this->body, ['text' => $replay, 'receiver' => $this->event->getUserId()]));
            }
            $this->replays = [];
            return;
        }
//        throw Exception
    }
    
    public function response() {
	    
    }
    
}