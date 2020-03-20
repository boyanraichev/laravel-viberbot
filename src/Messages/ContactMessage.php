<?php
namespace Boyo\Viberbot\Messages;

class ContactMessage extends ViberMessage
{
    protected $name;

    protected $type = 'contact';

    protected $phone_number;

    // TODO: Check does contact paramter works well
    public function body()
    {
        return array_merge(parent::body(), [
            'contact' => [
                'name' => '',
                'phone_number' => '',
            ],
        ]);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }
}
