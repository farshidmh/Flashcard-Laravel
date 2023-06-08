<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This class represents a flash card answer by the user
 * The status can be one of the following:
 * 1. False: answer is incorrect.
 * 2. True: answer is correct.
 * TODO: user_id should be a foreign key to the users table. since we don't have a users table for now, we just assume a default value for it.
 *
 * @version 1.0.0
 */
class FlashCardAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flash_card_id',
        'answer',
        'status'
    ];

    protected $attributes = [
        'user_id' => 1
    ];

    public function flashCard()
    {
        return $this->belongsTo(FlashCard::class);
    }

}
