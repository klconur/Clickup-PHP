<?php

namespace ClickUp\Objects;

use ClickUp\Client;

class User extends AbstractObject
{
    /* @var int $id */
    private $id;

    /* @var string $username */
    private $username;

    /* @var string $email */
    private $email;

    /* @var string|null $color */
    private $color = null;

    /* @var string|null $profilePicture */
    private $profilePicture = null;

    /* @var string $initials */
    private $initials;

    /* @var int $role */
    private $role;

    /* @var string|null $last_active */
    private $last_active = null;

    /* @var string|null $date_joined */
    private $date_joined = null;

    /* @var string $date_invited */
    private $date_invited;

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function color()
    {
        return $this->color;
    }

    /**
     * @return string|null
     */
    public function profilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * @return string
     */
    public function initials()
    {
        return $this->initials;
    }

    /**
     * @return int
     */
    public function role()
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function lastActive()
    {
        return $this->lastActive;
    }

    /**
     * @return string|null
     */
    public function dateJoined()
    {
        return $this->dateJoined;
    }

    /**
     * @return string
     */
    public function dateInvited()
    {
        return $this->dateInvited;
    }

    /**
     * @param array $array
     */
    protected function fromArray($array)
    {
        $this->id = $array['id'];
        $this->username = $array['username'];
        $this->email = $array['email'];
        $this->color = isset($array['color']) ? $array['color'] : null;
        $this->profilePicture = isset($array['profilePicture']) ? $array['profilePicture'] : null;
        $this->initials = isset($array['initials']) ? $array['initials'] : null;
        $this->role = isset($array['role']) ? $array['role'] : null;
        $this->last_active = isset($array['last_active']) ? $array['last_active'] : null;
        $this->date_joined = isset($array['date_joined']) ? $array['date_joined'] : null;
        $this->date_invited = isset($array['date_invited']) ? $array['date_invited'] : null;
    }
}
