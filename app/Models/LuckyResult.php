<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LuckyResult extends Model
{
    protected $fillable = ['user_id', 'random_number', 'result', 'win_amount'];

    // Getters
    public function getRandomNumber(): int
    {
        return $this->random_number;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function getWinAmount(): ?float
    {
        return $this->win_amount;
    }

    // Setters
    public function setRandomNumber(int $randomNumber): self
    {
        $this->random_number = $randomNumber;
        return $this;
    }

    public function setResult(string $result): self
    {
        $this->result = $result;
        return $this;
    }

    public function setWinAmount(?float $winAmount): self
    {
        $this->win_amount = round($winAmount, 2);
        return $this;
    }

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

