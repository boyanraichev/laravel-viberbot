<?php
namespace Boyo\Viberbot\Channel;

use Illuminate\Notifications\Notification;
use Boyo\Viberbot\Clients\Client;
use Boyo\Viberbot\Messages\ViberMessage;
use Boyo\Viberbot\Interfaces\ViberUser;
use Boyo\Viberbot\Exceptions\ViberBotException;

class ViberbotChannel
{
	
    protected $client;
    
    /**
     * @param Viber api client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return API response
     */
    public function send($notifiable, Notification $notification)
    {
        
        $message = $notification->toViberbot($notifiable);
        
        if (!$message instanceof ViberMessage) {
	        throw ViberBotException::noMessageProvided();
	    }
        
        if (!$message->receiver) {
            
            if (!$notifiable instanceof ViberUser) {
    	    	throw ViberBotException::noReceiverProvided();
            } else {
                $message->receiver($notifiable);
            }
            
        }
	    
        $this->client->send($message);
        
    }
    
    
}