<?php

namespace App\Repositories;

use App\Models\FlashCard;
use App\Repositories\Interfaces\FlashcardRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * This class is responsible for managing the flashcard repository.
 *
 *
 * @author Farshid Mehrtash
 * @implements FlashcardRepository
 * @version 1.0.0
 */
class EloquentFlashCardRepository implements FlashcardRepository
{
    /**
     * This method creates a new flashcard and returns it from the database layer to the service layer (action).
     * @param $question
     * @param $answer
     * @param $caseSensitive
     * @return FlashCard
     * @version 1.0.0
     */
    public function createFlashCard($question, $answer, $caseSensitive): FlashCard
    {
        return FlashCard::create([
            'question' => $question,
            'answer' => $answer,
            'answer_case_sensitive' => $caseSensitive,
        ]);
    }

    /**
     * This method creates a fetches a flashcard by its question from the database layer to the service layer (action).
     * @param $question
     * @return FlashCard|null
     * @version 1.0.0
     */
    public function getFlashCardByQuestion($question): FlashCard|null
    {
        return FlashCard::where('question', $question)->first();
    }

    /**
     * This is the method for fetching all flashcards.
     * @return Collection
     * @version 1.0.0
     */
    public function getAllFlasshCards(): Collection
    {
        return FlashCard::all();
    }
}
