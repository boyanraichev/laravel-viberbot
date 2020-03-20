<?php
namespace Boyo\Viberbot\Messages;

class LocationMessage extends ViberMessage
{
    protected $lat;

    protected $lng;

    protected $type = 'location';

    // TODO: Check does contact paramter works well
    public function body()
    {
        return array_merge(parent::body(), [
            'location' => [
                'lat' => '',
                'lon' => '',
            ],
        ]);
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng()
    {
        return $this->lng;
    }

    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }
}
