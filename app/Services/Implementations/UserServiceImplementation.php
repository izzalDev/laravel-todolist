<?php

namespace App\Services\Implementations;

use App\Services\UserService;

class UserServiceImplementation implements UserService
{
    private array $users = [
        "izzal" => "rizal123",
    ];

    function login(string $user, string $password): bool
    {
        if(!isset($this->users[$user])){
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
    }
}
