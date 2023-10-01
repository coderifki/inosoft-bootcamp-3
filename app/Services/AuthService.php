<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function login(array $credentials)
    {
        return $this->userRepository->login($credentials);
    }

    public function getAuthenticatedUser()
    {
        return $this->userRepository->getAuthenticatedUser();
    }
}
