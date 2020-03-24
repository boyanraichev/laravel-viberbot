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
	
	public $broadcast_list = null;
	
	public $keyboard = null;
	
	public $body = [];
	
	/**
     * Get the message type
     *
     * @return string $type
     */  
    public function getMessageType() {
		
		if (empty($this->type)) {
			throw ViberBotException::missingMessageType();
		}
		
		return $this->type;

	}

	/**
     * Set the message receiver
     *
     * @param ViberUser $user
     * @return obj $this
     */
    public function receiver(ViberUser $user) {
	    
		$viber_id = $user->getViberIdAttribute();
		
		if (empty($viber_id)) {
			throw ViberBotException::missingViberId();
		}

		$this->receiver = $viber_id;
		
		return $this;
		
    } 

	/**
     * Set the message multiple receivers
     *
     * @param collection of ViberUser $users
     * @return obj $this
     */    
    public function broadcast(array $users) {
	    
	    $broadcast_list = [];
	    
	    foreach($users as $user) {
		    
		    if (!$user instanceof ViberUser) {
		    	throw ViberBotException::noReceiverProvided();
		    }
		    
		    $broadcast_list[] = $user->getViberIdAttribute();
			
	    }
	    
	    $this->broadcast_list = $broadcast_list;
	    
	    return $this;
	    
	}
	
	/**
     * Set the message tracking data
     *
     * @param string $tracking_data
     * @return obj $this
     */       
    public function trackingData($tracking_data) {
	    
	    $this->tracking_data = $tracking_data;
	    
	    return $this;
	    
	}
	
	/**
     * Set the message min_api_version
     *
     * @param string $min_api_version
     * @return obj $this
     */ 
    public function minApiVersion($min_api_version) {
	    
	    $this->min_api_version = $min_api_version;
	    
	    return $this;
	    
	}

	/**
     * Attach keyboard to message
     *
     * @param array $keyboard 
     * @return obj $this
     */
    public function keyboard(array $keyboard) {
	    
	    $this->keyboard = $keyboard;
	    
	    return $this;
	    
	}

	/**
     * Get the message body
     *
     * @return array $body
     */	
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
	    
	    // broadcast
	    if (!empty($this->broadcast_list)) {
		    $this->body['broadcast_list'] = $this->broadcast_list;
	    }
	    
	    // keyboard
	    if (!empty($this->keyboard)) {
		    $this->body['keyboard'] = $this->keyboard;
	    } 	    

		return $this->body;
		
    }   
      
}
