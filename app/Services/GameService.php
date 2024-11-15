<?php

namespace App\Services;

use App\Models\LuckyResult;
use App\Models\User;

class GameService
{
    const LOSE = 'lose';
    const WIN = 'win';

    protected User $user;

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function feelingLucky(): LuckyResult
    {
        $randomNumber = rand(1, 1000);
        $winAmount = 0;
        $result = self::LOSE;

        if ($randomNumber % 2 === 0) {
            $result = self::WIN;
            $winAmount = match (true) {
                $randomNumber > 900 => $randomNumber * 0.7,
                $randomNumber > 600 => $randomNumber * 0.5,
                $randomNumber > 300 => $randomNumber * 0.3,
                default => $randomNumber * 0.1,
            };
        }

        return LuckyResult::create([
            'user_id' => $this->getUser()->getId(),
            'result' => $result,
            'random_number' => $randomNumber,
            'win_amount' => $winAmount,
        ]);
    }


}
