<?php

namespace App\Repositories\Interfaces;

use App\Models\FlashCard;

/**
 * This interface is responsible for managing the flashcard repository contract.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
interface FlashcardRepository
{
    /**
     * This is the template method for creating a new flashcard.
     * @param $question
     * @param $answer
     * @param $caseSensitive
     * @return mixed
     * @version 1.0.0
     */
    public function createFlashcard($question, $answer, $caseSensitive): FlashCard;


}
