<?php

namespace App\Actions;

use App\Repositories\Interfaces\FlashcardRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * This class is responsible for getting all flashcards and user's answers from the database layer to the service layer (action).
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetAllFlashCardsAndUsersAnswerAction
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
     * Get all flashcards and answer status based on user id from the database layer
     *
     * @param $userID
     * @return Collection
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($userID): Collection
    {
        return $this->flashcardRepository->getFlashCardAndUserAnswers($userID);
    }
}
