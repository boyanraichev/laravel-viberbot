<?php
namespace Boyo\Viberbot\Channel;

use Illuminate\Notifications\Notification;
use Boyo\Viberbot\Clients\Client;
use Boyo\Viberbot\Messages\ViberMessage;

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
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        
        $message = $notification->toViberbot($notifiable);
        
        if (!$message instanceof ViberMessage) {
	        throw new \Exception('No message provided');
	    }
	    
	    $message->buildData();
	    
        $this->client->send($message, $notifiable);
        
    }
    
    
}