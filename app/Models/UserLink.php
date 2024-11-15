<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, \Illuminate\Routing\Route|object|string|null $link)
 * @property mixed $link
 * @property bool $is_active
 */
class UserLink extends Model
{
    protected $fillable = ['user_id', 'link', 'expires_at', 'is_active'];

   public function getLink(): string
   {
       return $this->link;
   }

    public function getUser(): User
    {
        return $this->user;
    }

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }


}
