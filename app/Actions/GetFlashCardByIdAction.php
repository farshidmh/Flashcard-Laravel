<?php

namespace App\Actions;

use App\Models\FlashCard;
use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for getting a flashcard by its id.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetFlashCardByIdAction
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
     * Get a flashcard by its id from the database layer.
     *
     * @param $flashcardID
     * @return FlashCard|null
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($flashcardID): FlashCard|null
    {

        return $this->flashcardRepository->getFlashCardByID($flashcardID);

    }
}
