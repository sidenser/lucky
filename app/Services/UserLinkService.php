<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserLink;
use Illuminate\Support\Str;

class UserLinkService
{
    public function __construct()
    {}

    public function create(User $user): UserLink
    {
        $userLink = UserLink::create([
            'user_id' => $user->id,
            'link' => Str::uuid(),
            'expires_at' => now()->addDays(7),
            'is_active' => true,
        ]);

        return $userLink;
    }

    public function disable(UserLink $userLink): bool
    {
        $userLink->setIsActive(false);
        return $userLink->save();
    }

    public function regenerate(UserLink $userLink): UserLink
    {
        $this->disable($userLink);

        return UserLink::create([
            'user_id' => $userLink->getUser()->getId(),
            'link' => Str::uuid(),
            'expires_at' => now()->addDays(7),
            'is_active' => true,
        ]);
    }
}
