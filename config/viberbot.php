<?php

return [
	
    'api_key' => env('VIBERBOT_API'),
    
    'name' => env('VIBERBOT_NAME',false),
    
    'photo' => env('VIBERBOT_PHOTO',false),
    
    'event_types' => [
        'delivered',
        'seen',
        'failed',
        'subscribed',
        'unsubscribed',
        'conversation_started',
    ],
    
];