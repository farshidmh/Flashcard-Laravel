<?php

namespace App\Actions;

use App\Repositories\Interfaces\FlashcardRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * This class is responsible for getting all flashcards .
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class GetAllFlashCards
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
     * Get all flashcards from the database layer.
     *
     * @return Collection
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute(): Collection
    {
        return $this->flashcardRepository->getAllFlasshCards();
    }
}
