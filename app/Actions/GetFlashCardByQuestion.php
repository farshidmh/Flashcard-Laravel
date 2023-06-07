<?php

namespace App\Actions;

use App\Models\FlashCard;
use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for getting a flashcard by its question.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetFlashCardByQuestion
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
     * Get a flashcard by its question from the database layer.
     *
     * @param $question
     * @return FlashCard|null
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($question): FlashCard|null
    {
        $question = trim($question);
        return $this->flashcardRepository->getFlashCardByQuestion($question);

    }
}
