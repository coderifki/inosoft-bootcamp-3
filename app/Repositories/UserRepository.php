<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $data)
    {
        return $this->user->create($data);
    }

    public function findByEmail(string $email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function login(array $credentials)
    {
        if (!$token = auth()->attempt($credentials)) {
            return false;
        }

        return $token;
    }

    public function getAuthenticatedUser()
    {
        return auth()->user();
    }
}
