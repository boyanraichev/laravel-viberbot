<?php
namespace Boyo\Viberbot\Messages;

class TextMessage extends ViberMessage
{
		
    protected $type = 'text';
    
    public $text = '';
    
    public function __construct(string $text) 
    {
	    $this->text = $text;
    }

    public function getBody()
    {
	    
	    parent::getBody();
	    
	    $this->body['text'] = $this->text;
	     
	    return $this->body; 

    }

}
