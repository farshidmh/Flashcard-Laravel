<?php

namespace App\Console\Commands;

use App\Actions\DeleteAllFlashCardAction;
use App\Actions\ResetFlashCardAnswerAction;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ResetFlashcardCommand extends Command
{
    /*
     * The user ID to be used for deleting all flashcards.
     */
    private $userId = 1;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive CLI program for resetting flashcards';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        ResetFlashCardAnswerAction $resetFlashCardAnswerAction,
        DeleteAllFlashCardAction   $deleteAllFlashCardAction
    )
    {

        $choice = '';
        while ($choice !== '3') {

            $this->line('---------');
            $this->info(__("flashcards.reset_panel"));
            $this->line('---------');
            $this->info('1. ' . __("flashcards.reset_answer"));
            $this->info('2. ' . __("flashcards.reset_all"));
            $this->info('3. ' . __("flashcards.back"));
            $this->line('---------');

            $choice = $this->ask(__("flashcards.reset_enter_choice"));

            switch ($choice) {
                case 1:
                    $resetFlashCardAnswerAction->execute($this->userId);
                    $this->info(__("flashcards.reset_answer_success"));
                    break;
                case 2:
                    $deleteAllFlashCardAction->execute($this->userId);
                    $this->info(__("flashcards.reset_all_success"));
                    break;
                case 3:
                    break;
                default:
                    $this->error(__("flashcards.invalid_choice"));
                    break;
            }

        }

        return CommandAlias::SUCCESS;
    }

}
