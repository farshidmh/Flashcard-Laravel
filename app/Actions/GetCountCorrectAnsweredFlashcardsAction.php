<?php

namespace App\Actions;

use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for calculating number of user's correct answers.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetCountCorrectAnsweredFlashcardsAction
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
     * Calculating number of user's correct answers.
     *
     * @param $userId
     * @return int
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($userId): int
    {
        return $this->flashcardRepository->getFlashCardCorrectAnswersByUser($userId)->count();
    }
}
