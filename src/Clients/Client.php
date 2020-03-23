<?php
namespace Boyo\Viberbot\Clients;

use Boyo\Viberbot\Http\ApiClient;
use Boyo\Viberbot\Messages\ViberMessage;
use Boyo\Viberbot\Interfaces\ViberUser;

class Client
{
    
    public function send(ViberMessage $message, ViberUser $user)
    {
	    
	    $message->receiver($user);
	    
        $body = $message->getBody();
        
	    $response = ApiClient::call('POST', 'send_message', $body );
	    
    }
    
    public function broadcast(ViberMessage $message, array $users) 
    {
	    
	    
	    
	}
    
}