<?php

namespace App\Repositories;

use App\Models\LuckyResult;
use Illuminate\Database\Eloquent\Collection;

class LuckyResultRepository
{
    public function getLastLuckyResult(int $userId, int $limit = 3): Collection
    {
        return LuckyResult::where('user_id', $userId)->limit($limit)->orderBy('created_at', 'desc')->get();
    }
}
