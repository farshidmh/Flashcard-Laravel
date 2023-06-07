<?php

namespace App\Console\Commands;

use App\Actions\GetFlashCardByQuestion;
use App\Actions\NewFlashCardAction;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateFlashcardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive CLI program for creating flashcards';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(
        NewFlashCardAction     $newFlashCardAction,
        GetFlashCardByQuestion $getFlashCardByQuestion
    )
    {
        do {
            $question = $this->ask(__("flashcards.flashcard_question"));

            if ($existing = $getFlashCardByQuestion->execute($question)) {
                $this->error(__("flashcards.flashcard_already_exists", ['id' => $existing->id]));
            } else {
                $answer = $this->ask(__("flashcards.flashcard_answer"));
                $caseSensitive = $this->choice(__("flashcards.flashcard_case_sensitive"), ['no', 'yes'], 0);
                $flashCard = $newFlashCardAction->execute($question, $answer, $caseSensitive);
                $this->info(__("flashcards.flashcard_created", ['id' => $flashCard->id]));
            }

            $this->line(__('================'));
            $createNewQuestion = $this->confirm("Do you want to create another flashcard?", true);

        } while ($createNewQuestion);

        return CommandAlias::SUCCESS;
    }

}
