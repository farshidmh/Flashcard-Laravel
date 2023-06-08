<?php

namespace App\Actions;

/**
 * This class is responsible for calculating the completion percentage of a flashcard set with answer.
 *
 *
 *
 * @author Farshid Mehrtash
 * @version 1.0.0
 */
class getPercentageFlashcardWithAnswerAction
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
        $withAnswer = 0;

        foreach ($flashcards as $flashcard) {
            if (!is_null($flashcard->answer_status)) {
                $withAnswer++;
            }
        }

        if ($totalFlashcards > 0) {
            $completionPercentage = round($withAnswer / $totalFlashcards * 100, 2);
        } else {
            $completionPercentage = 0;
        }

        return $completionPercentage;
    }
}
