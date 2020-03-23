<?php
namespace Boyo\Viberbot\Messages;

use Boyo\Viberbot\Interfaces\ViberUser;
use Boyo\Viberbot\Exceptions\ViberBotException;

abstract class ViberMessage
{
	
	protected $type = null;
	
	public $min_api_version = '1';
	
	public $tracking_data = '';
	
	public $receiver = null;
	
	public $keyboard = null;
	
	public $body = [];
	
    public function getMessageType() {
		
		if (empty($this->type)) {
			throw ViberBotException::missingMessageType();
		}
		
		return $this->type;

	}

    public function receiver(ViberUser $user) {
	    
		$viber_id = $user->getViberIdAttribute();
		
		if (empty($viber_id)) {
			throw ViberBotException::missingViberId();
		}

		$this->receiver = $viber_id;
		
		return $this;
		
    } 
     
    public function trackingData($tracking_data) {
	    
	    $this->tracking_data = $tracking_data;
	    
	    return $this;
	    
	}

    public function minApiVersion($min_api_version) {
	    
	    $this->min_api_version = $min_api_version;
	    
	    return $this;
	    
	}

    public function keyboard(array $keyboard) {
	    
	    $this->keyboard = $keyboard;
	    
	    return $this;
	    
	}
	
    public function getBody() {
		
		 $this->body = [
		    'min_api_version' => $this->min_api_version,
			'sender' => [
				'name' => config('viberbot.name'),
				'avatar' => config('viberbot.photo'),
			],
			'tracking_data' => $this->tracking_data,
			'type' => $this->getMessageType(),
	    ];
	    
	    // receiver
	    if (!empty($this->receiver)) {
		    $this->body['receiver'] = $this->receiver;
	    } 
	    
	    // keyboard
	    if (!empty($this->keyboard)) {
		    $this->body['keyboard'] = $this->keyboard;
	    } 	    

		return $this->body;
		
    }   
      
}
