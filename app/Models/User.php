<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $id
 */
class User extends Model
{
    protected $fillable = [
        'username',
        'phone',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function getId()
    {
        return $this->id;
    }

    public function luckyResults(): HasMany
    {
        return $this->hasMany(LuckyResult::class);
    }

    public function userLinks(): HasMany
    {
        return $this->hasMany(UserLink::class);
    }
}
