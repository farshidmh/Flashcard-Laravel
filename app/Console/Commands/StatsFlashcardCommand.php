<?php

namespace App\Console\Commands;

use App\Actions\getPercentageFlashcardWithAnswerAction;
use App\Actions\getPercentageFlashcardWithCorrectAnswerAction;
use App\Actions\GetAllFlashCardsAndUsersAnswerAction;
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
     *
     * @return int
     */
    public function handle(
        getPercentageFlashcardWithCorrectAnswerAction $calculateCompletionPercentageAction,
        getPercentageFlashcardWithAnswerAction        $answeredPercentage,
        GetFlashCardCountAction                       $getFlashCardCountAction,
        GetAllFlashCardsAndUsersAnswerAction          $getAllFlashCards,
    )
    {

        $flashcards = $getAllFlashCards->execute($this->userId);

        $this->info(__('flashcards.total_questions', ['count' => $getFlashCardCountAction->execute()]));
        $this->info(__('flashcards.answered_percentage', ['percentage' => $answeredPercentage->execute($flashcards)]));
        $this->info(__('flashcards.correct_percentage', ['percentage' => $calculateCompletionPercentageAction->execute($flashcards)]));

        return CommandAlias::SUCCESS;
    }
}
