<?php

namespace App\Actions;

use App\Models\FlashCard;
use App\Models\FlashCardAnswer;
use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for getting a flashcard answer for a user.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetFlashCardAnswerByUserAction
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
     * Get a flashcard answer for user.
     *
     * @param $flashcardID
     * @param $userID
     * @return FlashCardAnswer|null
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($flashcardID, $userID): FlashCardAnswer|null
    {
        return $this->flashcardRepository->getFlashCardAnswerUser($flashcardID, $userID);
    }
}
