<?php

class Id
{
    private $id;

    private function __construct($id)
    {
        $this->id = $id;
    }

    static function fromString($id)
    {
        return new self($id);
    }

    public function id()
    {
        return $this->id;
    }


}
