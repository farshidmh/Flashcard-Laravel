<?php

namespace App\Actions;

/**
 * This class is responsible for getting number of all flashcards the database layer.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetAllFlashCardsCountAction
{
    private GetAllFlashCards $getAllFlashCards;

    /**
     * inject the flashcard repository dependency.
     *
     * @return void
     */
    public function __construct(GetAllFlashCards $getAllFlashCards)
    {
        $this->getAllFlashCards = $getAllFlashCards;
    }

    /**
     * Get number of all flashcards from the database layer.
     *
     * @return int
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute(): int
    {
        return $this->getAllFlashCards->execute()->count();
    }
}
