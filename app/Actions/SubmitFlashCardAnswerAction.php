<?php

namespace App\Actions;

use App\Repositories\Interfaces\FlashcardRepository;

/**
 * This class is responsible for checking submitting a flash card answer.
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class SubmitFlashCardAnswerAction
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
     * This method is responsible for checking and submitting a flash card answer.
     *
     * @param $userId
     * @param $flashCardID
     * @param $answer
     * @return bool
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($userId, $flashCardID, $answer): bool
    {

        $flashCard = $this->flashcardRepository->getFlashCardByID($flashCardID);

        $isCorrect = strtolower($flashCard->answer) === strtolower($answer);

        if ($flashCard->answer_case_sensitive) {
            $isCorrect = $flashCard->answer === $answer;
        }

        $this->flashcardRepository->submitFlashCardAnswer($flashCardID, $answer, $isCorrect, $userId);

        return $isCorrect;
    }
}
