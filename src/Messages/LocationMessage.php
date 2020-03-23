<?php
namespace Boyo\Viberbot\Messages;

class LocationMessage extends ViberMessage
{

    protected $type = 'location';
    
    public $lat;

    public $lon;

	public function __construct(string $lat, string $lon) 
    {
	    $this->lat = $lat;
	    $this->lon = $lon; 
    }
    
    public function getBody()
    {
	    
	    parent::getBody();
	    
	    $this->body['location'] = [
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
	     
	    return $this->body; 

    }
    
}
