<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * This class represents a flash card.
 * A flash card has a question, an answer, and a status.
 * The status can be one of the following:
 * 1. False: Question is disabled.
 * 2. True: Question is enabled.
 *
 * answer_case_sensitive is a boolean that indicates whether the answer is case-sensitive or not (default is false) when checking the answer.
 *
 * @version 1.0.0
 */
class FlashCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'answer_case_sensitive',
        'status',
    ];

    public function userFlashCardAnswers()
    {
        return $this->hasMany(FlashCardAnswer::class);
    }
}
