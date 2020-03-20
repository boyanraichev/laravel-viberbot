<?php
namespace Boyo\Viberbot\Messages;

class TextMessage extends ViberMessage
{
    protected $text;

    protected $type = 'text';

    public function body()
    {
        return array_merge(parent::body(), [
            'text' => $this->text,
        ]);
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
}
