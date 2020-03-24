<?php
namespace Boyo\Viberbot\Clients;

use Boyo\Viberbot\Http\ApiClient;
use Boyo\Viberbot\Messages\ViberMessage;
use Boyo\Viberbot\Interfaces\ViberUser;
use Boyo\Viberbot\Exceptions\ViberBotException;

class Client
{
    /**
     * Send a message
     *
     * @param  ViberMessage  $message
     * @param  ViberUser  $user
     * @return API response
     */
    public function send(ViberMessage $message, ?ViberUser $user = null)
    {
	    
	    if ($user) {
	    
	    	$message->receiver($user);
	    
	    }
        
	    $response = ApiClient::call('POST', 'send_message', $message->getBody() );
	    
	    return $response;
	    
    }
    
    /**
     * Send a message to multiple users (max 200)
     *
     * @param  ViberMessage  $message
     * @param  Collection of ViberUser $users
     * @return API response
     */    
    public function broadcast(ViberMessage $message, array $users) 
    {
	    
	    $message->broadcast($users);
	    
	    $response = ApiClient::call('POST', 'broadcast_message', $message->getBody() );
	    
	    return $response;
	    
	}
    
}