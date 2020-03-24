<?php
namespace Boyo\Viberbot\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Boyo\Viberbot\Http\ApiClient;
use Boyo\Viberbot\Events\WebhookEvent;
use Boyo\Viberbot\Events\ConversationStartedEvent;
use Boyo\Viberbot\Events\SubscribedEvent;
use Boyo\Viberbot\Events\UnsubscribedEvent;
use Boyo\Viberbot\Events\SeenEvent;
use Boyo\Viberbot\Events\MessageEvent;

class Bot
{
	// loggin
	protected $log;
	
	// incoming request
    protected $request;
    
    // the event received
    protected $event = false;
    
    // event matched in on()
    protected $match = false;
    
    // text matched in hears()
    protected $heard = false;
    
    // heard has been answered
    protected $answered = false;   
    
    // ifelse chaining
    protected $ifelse = null;        
    	        
	// message replies to send
	protected $replies = [];     
        
    // response to hook -> if left empty will respond true and status 200
	protected $response = null;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
        
        $this->log = config('viberbot.log');
        
        if (!empty($this->request->event)) {
	        
	        if ($this->log) {
		        Log::channel('viberbot')->info('Event received.',$this->request->all());
	        }
	        
	        switch($this->request->event) {
		        case 'webhook':
		        	$this->event = new WebhookEvent($this->request);
		        	break;
		        case 'conversation_started':
					$this->event = new ConversationStartedEvent($this->request);    
		        	break;
		        case 'subscribed':
		        	$this->event = new SubscribedEvent($this->request);
		        	break;
		        case 'unsubscribed':
		        	$this->event = new UnsubscribedEvent($this->request);
		        	break;
		        case 'message':
		        	$this->event = new MessageEvent($this->request);
		        	break;   
		        case 'failed':
		        	$this->event = new FailedEvent($this->request);
		        	break;   
		        case 'delivered':
		        	$this->event = new DeliveredEvent($this->request);
		        	break;   
		        case 'seen':
		        	$this->event = new SeenEvent($this->request);
		        	break;   	
	        }
        }
    }
    
    /*
    * matches with event received
    */
    public function on($event)
    {
        $this->match = ($this->event && $this->event->getEvent() === $event);
        
        $this->ifelse = null;
        
        return $this;
    }
    
	/*
    * additional condition for match in event data received
    */
    public function condition(string $property, $value)
    {
	    if ($this->match) {
        	$this->match = ( isset($this->event->$property) && $this->event->$property == $value );
        }
        
        return $this;
    }
    
    /*
    * fires a callback for additional actions to be performed in the app upon event received
    */
    public function do($callback)
    {
	    if ($this->match) { 
		    $callback($this->event);
		}
        
        return $this;   
	}
	
	/*
    * sets a response by the hook, needed in "conversation_started" events
    */
	public function response($message, $data = null) 
	{
		if ($this->match) { 
			$this->response = (new $message($data))->getBody();
		}
		
		return $this;	
	}
	    
    /*
    * matches incoming text for specific words
    * 
    * $words can be a string (single word/phrase) or an array (multiple words/phrases). 
    * $match_all weather all strings in the $words array should be matched or any
    */    
    public function hears($words,$match_all=false)
    {
	    if ($this->match && !$this->heard) { 
			    
	        if (is_array($words) && count($words)>0) {
		        if ($match_all) {
			        $this->heard = true;
		            foreach ($words as $text) {
			            if (!$this->matchText($text)) {
				            $this->heard = false;
			            }
		            }		        
		        } else {
			        $this->heard = false;
		            foreach ($words as $text) {
			            if ($this->matchText($text)) {
				            $this->heard = true;
			            }
		            }
		        }
	        }
	        
	        if (is_string($words)) {
	           $this->heard = $this->matchText($words);
	        }
			
		}
		
        return $this;
    }
    
    /*
    * matches a string in the text, checks for regex
    */    
    public function matchText($text) {
	    
	    if (substr($text,0,1)==='/') {
		    
		    return ( preg_match($text, $this->event['message']['text']) === 1 );
		    
	    } else {
		    
		    return $text === $this->event['message']['text'];
		    
	    }
	    
    }
    
    /*
    * sets an answer if heard something
    */    
    public function answers($message, $data = null)
    {
        if ($this->heard && !$this->answered) { 
        	$this->replies[] = new $message($data);
        	$this->answered = true;
        }
        
        return $this;
    }
    
    /*
	 * sets an answer if no match was found 
	 */
	public function defaultReply($message, $data = null)
	{
		if ($this->match && !$this->answered) { 
        	$this->replies[] = new $message($data);
        	$this->answered = true;
        }
        
        return $this;
	}

    /*
    * adds a reply to be send
    */        
    public function reply($message)
    {
        if ($this->match) { 
        	$this->replies[] = new $message($data);
        }
        
        return $this;
    }

	/*
    * if else conditioning 
    */        
    public function if($statement)
    {
		if ($this->match) { 
			
			$this->ifelse = true;
			
			$this->match = (bool) $statement;
			
		}
        
        return $this;
	}
	
	/*
    * if else conditioning 
    */        
    public function else()
    {
		if ($this->ifelse) { 

			$this->match = !$this->match;
			
		}
        
        return $this;
	}
	
    /*
    * sends all replies
    */        
    public function send()
    {

        foreach ($this->replies as $reply) {
	        
	        // set user? from event data?
	        
	        // set body?
	        
            ApiClient::call('POST', 'send_message', $reply->getBody());
        }
        
        $this->replies = [];
        
        return $this;

    }
    
    /*
    * returns the response by the hook
    */        
    public function respond() {
	    
	    if ($this->response) {
		    return response()->json($this->response, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
	    }
	 
		return response()->json(true, 200, ['Content-Type' => 'application/json; charset=UTF-8'], JSON_UNESCAPED_UNICODE);
				   
    }
    
    /*
	 * Returns the event
	 */
    public function getEventObject() {
	    
	    return $this->event;
	    
    }
    
}