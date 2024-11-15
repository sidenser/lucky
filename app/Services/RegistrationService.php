<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserLink;

class RegistrationService
{
    private string $username;

    private string $phone;

    public function __construct(private UserLinkService  $userLinkService)
    {}

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function register(): UserLink
    {
        $user = User::create([
            'username' => $this->getUsername(),
            'phone' => $this->getPhone(),
        ]);

        return $this->userLinkService->create($user);
    }
}
