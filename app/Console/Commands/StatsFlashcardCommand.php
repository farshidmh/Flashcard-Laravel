<?php

namespace App\Console\Commands;

use App\Actions\GetCountAnsweredFlashcardsAction;
use App\Actions\GetCountCorrectAnsweredFlashcardsAction;
use App\Actions\CalculatePercentageAction;
use App\Actions\GetFlashCardCountAction;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class StatsFlashcardCommand extends Command
{

    /*
     * The user ID to be used for answering flashcards.
     */
    private $userId = 1;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive CLI program for practicing flashcards';

    /**
     * Execute the console command.
     * Note: Document explicitly mentioned that the formula should be correct flashcards vs total flashcards
     *
     *
     * @return int
     */
    public function handle(
        CalculatePercentageAction               $calculateCompletionPercentageAction,
        GetFlashCardCountAction                 $getFlashCardCountAction,
        GetCountCorrectAnsweredFlashcardsAction $getCountCorrectAnsweredFlashcardsAction,
        GetCountAnsweredFlashcardsAction        $getCountAnsweredFlashcardsAction,
    )
    {

        $flashcardsCount = $getFlashCardCountAction->execute();
        $answered = $getCountAnsweredFlashcardsAction->execute($this->userId);
        $correct = $getCountCorrectAnsweredFlashcardsAction->execute($this->userId);


        $this->info(__('flashcards.total_questions', ['count' => $getFlashCardCountAction->execute()]));
        $this->info(__('flashcards.answered_percentage', ['percentage' => $calculateCompletionPercentageAction->execute($flashcardsCount, $answered)]));
        $this->info(__('flashcards.correct_percentage', ['percentage' => $calculateCompletionPercentageAction->execute($flashcardsCount, $correct)]));

        return CommandAlias::SUCCESS;
    }
}
