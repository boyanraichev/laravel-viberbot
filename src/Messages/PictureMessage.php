<?php
namespace Boyo\Viberbot\Messages;

class PictureMessage extends ViberMessage
{
	
	/*
	{  
	   "type":"picture",
	   "text":"Photo description",
	   "media":"http://www.images.com/img.jpg",
	   "thumbnail":"http://www.images.com/thumb.jpg"
	}
	*/

    protected $type = 'picture';
    	
    public $text;

    public $media;

    public $thumbnail;

	public function __construct(string $text, string $media, string $thumbnail) 
    {
	    $this->text = $text;
	    $this->media = $media;
   	    $this->thumbnail = $thumbnail; 	    
    }
    
    public function getBody()
    {
	    
	    parent::getBody();
	    
	    $this->body['text'] = $this->text;
	    $this->body['media'] = $this->media;
	    $this->body['thumbnail'] = $this->thumbnail;
	     
	    return $this->body; 

    }
    
}
