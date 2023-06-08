<?php

namespace App\Actions;

use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for getting count of flashcards.
 *
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetFlashCardCountAction
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
     * This method is responsible for getting count of flashcards.
     *
     * @return float
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute(): float
    {
        return $this->flashcardRepository->getFlashCardsCount();
    }
}
