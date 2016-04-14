<?php

namespace Core\Events;

class UserCreated extends Event
{

    public $user;

    /**
     * UserCreated constructor.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

}