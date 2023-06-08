<?php

namespace App\Actions;

/**
 * This class is responsible for calculating the completion percentage of a flashcard set with correct answer.
 * Note: Document explicitly mentioned that the formula should be correct flashcards vs total flashcards
 *
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class getPercentageFlashcardWithCorrectAnswerAction
{

    /**
     * This method is responsible for calculating the completion percentage of a flashcard set.
     *
     * @param $flashcards
     * @return float
     *
     * @author Farshid Mehrtash
     * @version 1.0.0
     */
    public function execute($flashcards): float
    {

        $totalFlashcards = count($flashcards);
        $correctFlashcards = 0;

        foreach ($flashcards as $flashcard) {
            if ($flashcard->answer_status == 1) {
                $correctFlashcards++;
            }
        }

        if ($totalFlashcards > 0) {
            $completionPercentage = round($correctFlashcards / $totalFlashcards * 100, 2);
        } else {
            $completionPercentage = 0;
        }

        return $completionPercentage;
    }
}
