<?php

namespace App\Actions;

use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for deleting user's answers from the database.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class ResetFlashCardAnswerAction
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
     * This method is responsible for deleting user's answers from the database.
     *
     * @param $userId
     * @return void
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($userId): void
    {
        $this->flashcardRepository->deleteAllFlashCardUserAnswer($userId);
    }
}
