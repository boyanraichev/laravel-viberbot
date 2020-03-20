<?php
namespace Boyo\Viberbot\Messages;

class KeyboardMessage extends ViberMessage 
{
    protected $text;

    protected $type = 'text';

    protected $keyboard;

    public function body()
    {
        $array = array_merge(parent::body(), [
            'text' => $this->getText(),
            'keyboard' => $this->getKeyboard(),
        ]);

        unset(
            $array['sender'],
            $array['tracking_data'],
            $array['min_api_version']
        );

        return $array;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getKeyboard()
    {
        return $this->keyboard;
    }

    public function setKeyboard($keyboard)
    {
        $this->keyboard = $keyboard;

        return $this;
    }
}
