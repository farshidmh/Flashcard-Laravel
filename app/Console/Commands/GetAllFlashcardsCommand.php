<?php

namespace App\Console\Commands;

use App\Actions\GetAllFlashCards;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GetAllFlashcardsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:getAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive CLI program for getting all the flashcards';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(GetAllFlashCards $getAllFlashCards)
    {
        $flashcards = $getAllFlashCards->execute();
        $rows = [];

        foreach ($flashcards as $flashcard) {
            $rows[] = [$flashcard->question, $flashcard->answer, $flashcard->answer_case_sensitive ? 'yes' : 'no'];
        }
        $this->table(['Question', 'Answer', 'Case Sensitive'], $rows);

        return CommandAlias::SUCCESS;
    }

}
