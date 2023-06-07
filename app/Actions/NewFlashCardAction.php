<?php

namespace App\Actions;

use App\Models\FlashCard;
use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for creating a new flashcard.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class NewFlashCardAction
{

    private FlashcardRepository $flashcardRepository;

    /**
     * inject the flashcard repository dependency.
     *
     * @return void
     */
    public function __construct(FlashcardRepository $flashcardRepository)
    {
        $this->flashcardRepository = $flashcardRepository;
    }

    /**
     * This method creates a new flashcard and returns it.
     *
     * @param $question
     * @param $answer
     * @param $caseSensitive
     * @return FlashCard
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     *
     */
    public function execute($question, $answer, $caseSensitive): FlashCard
    {
        $question = trim($question);
        $answer = trim($answer);
        $caseSensitive = $caseSensitive == 'yes';
        return $this->flashcardRepository->createFlashcard($question, $answer, $caseSensitive);
    }
}
