<?php

namespace App\Repositories;

use App\Models\FlashCard;
use App\Models\FlashCardAnswer;
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


    /**
     * This is the method for fetching a flashcard by its ID.
     * @param $flashCardID
     * @return FlashCard
     */
    public function getFlashCardByID($flashCardID): FlashCard
    {
        return FlashCard::findOrFail($flashCardID);
    }

    /**
     * This is the  method for submitting a flashcard answer.
     * @param $flashCardID
     * @param $answer
     * @param $status
     * @param $userId
     * @return void
     */
    public function submitFlashCardAnswer($flashCardID, $answer, $status, $userId): void
    {
        $flashCard = $this->getFlashCardByID($flashCardID);

        $flashCard->userFlashCardAnswers()->create([
            'user_id' => $userId,
            'answer' => $answer,
            'status' => $status,
        ]);

    }


    /**
     * This is the template method for fetching flashcards and user's answers.
     * @param $userID
     * @return Collection
     */
    public function getFlashCardAndUserAnswers($userID): Collection
    {
        return FlashCard::leftJoin('flash_card_answers', function ($join) use ($userID) {
            $join->on('flash_cards.id', '=', 'flash_card_answers.flash_card_id')
                ->where('flash_card_answers.user_id', '=', $userID);
        })
            ->select('flash_cards.id', 'flash_cards.question', 'flash_card_answers.status as answer_status', 'flash_card_answers.answer as user_answer')
            ->orderBy('flash_cards.id')
            ->get();
    }

    /**
     * This is the  method for delete all flashcards' users' answers.
     * @param $userID
     * @return void
     */
    public function deleteAllFlashCardUserAnswer($userID): void
    {
        FlashCardAnswer::where('user_id', $userID)->delete();
    }

    /**
     * This is the method for delete all flashcards.
     * @param $userID
     * @return void
     */
    public function deleteAllFlashCards($userID): void
    {
        FlashCard::query()->delete();
    }

    /**
     * This is the method for getting count of all flashcards.
     * @return int
     */
    public function getFlashCardsCount(): int
    {
        return FlashCard::count();
    }
}
