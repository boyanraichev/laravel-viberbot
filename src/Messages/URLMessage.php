<?php
namespace Boyo\Viberbot\Messages;

class URLMessage extends ViberMessage
{
    protected $media;

    protected $type = 'url';

    public function body()
    {
        return array_merge(parent::body(), [
            'media' => $this->media,
        ]);
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }
}
