<?php

namespace App\Repositories;

use App\Models\FlashCard;
use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for managing the flashcard repository.
 *
 *
 * @author Farshid Mehrtash
 * @implements FlashcardRepository
 * @version 1.0.0
 */
class EloquentFlashCardRepository implements FlashcardRepository
{
    /**
     * This method creates a new flashcard and returns it from the database layer to the service layer (action).
     * @param $question
     * @param $answer
     * @param $caseSensitive
     * @return FlashCard
     * @version 1.0.0
     */
    public function createFlashCard($question, $answer, $caseSensitive): FlashCard
    {
        return FlashCard::create([
            'question' => $question,
            'answer' => $answer,
            'answer_case_sensitive' => $caseSensitive,
        ]);
    }

}
