<?php

namespace App\Repositories\Interfaces;

use App\Models\FlashCard;
use Illuminate\Database\Eloquent\Collection;

/**
 * This interface is responsible for managing the flashcard repository contract.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
interface FlashcardRepository
{
    /**
     * This is the template method for creating a new flashcard.
     * @param $question
     * @param $answer
     * @param $caseSensitive
     * @return mixed
     * @version 1.0.0
     */
    public function createFlashcard($question, $answer, $caseSensitive): FlashCard;

    /**
     * This is the template method for fetching a flashcard by its question.
     * @param $question
     * @return FlashCard|null
     * @version 1.0.0
     */
    public function getFlashCardByQuestion($question): FlashCard|null;

    /**
     * This is the template method for fetching all flashcards.
     * @return Collection
     * @version 1.0.0
     */
    public function getAllFlasshCards(): Collection;

    /**
     * This is the template method for fetching a flashcard by its ID.
     * @param $flashCardID
     * @return FlashCard
     */
    public function getFlashCardByID($flashCardID): FlashCard;

    /**
     * This is the template method for submitting a flashcard answer.
     * @param $flashCardID
     * @param $answer
     * @param $status
     * @param $userId
     * @return void
     */
    public function submitFlashCardAnswer($flashCardID, $answer, $status, $userId): void;

    /**
     * This is the template method for fetching flashcards and user's answers.
     * @param $userID
     * @return Collection
     */
    public function getFlashCardAndUserAnswers($userID): Collection;
}
