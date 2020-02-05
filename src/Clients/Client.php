<?php
namespace Boyo\Viberbot\Clients;

use Boyo\Viberbot\Http\ApiClient;
use Boyo\Viberbot\Messages\ViberMessage;
use Boyo\Viberbot\Interfaces\ViberUser;

class Client
{
    
    public function send(ViberMessage $message, ViberUser $user)
    {
	    
        $data = $message->getData();
        
	    $response = ApiClient::call('POST', 'send_message', $data );
	    
	    
    }
    
    public function broadcast(ViberMessage $message) 
    {
	    
	    
	    
	}
    
}