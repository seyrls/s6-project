<?php

namespace App\Managers\Auth;


use App\Models\User;
use Illuminate\Auth\Authenticatable;

class AuthManager
{
    use Authenticatable;

    private $repo;

    public function __construct(User $user)
    {
        $this->repo = $user;
    }

    public function getUserByEmail(string $email)
    {
        return $this->repo::where('email', $email)->first();
    }

    public function generateToken()
    {
        return  md5(rand(1, 60));
    }
}