<?php
namespace Boyo\Viberbot\Messages;

class WelcomeMessage extends ViberMessage
{
    // TODO: Welcome Message

    protected $text;

    public function body()
    {
        $array = array_merge(parent::body(), [
            'text' => $this->text,
        ]);

        unset($array['receiver']);

        return $array;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): void
    {
        $this->text = $text;
    }
}
