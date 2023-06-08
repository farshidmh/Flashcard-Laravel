<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    public function userFlashCardAnswers()
    {
        return $this->hasMany(UserFlashCardAnswer::class);
    }




}
