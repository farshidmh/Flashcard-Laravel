<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the user's flashcard answers.
     * @return mixed
     *
     * @version 1.0.0
     */
    public function userFlashCardAnswers()
    {
        return $this->hasMany(UserFlashCardAnswer::class);
    }


}
