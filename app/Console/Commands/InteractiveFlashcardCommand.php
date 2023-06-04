<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class InteractiveFlashcardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashcard:interactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive CLI program for Flashcard practice';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Welcome to the Flashcard practice program!");
        $this->displayMainMenu();
        return CommandAlias::SUCCESS;
    }

    private function displayMainMenu()
    {
        $choice = '';
        while ($choice !== '6') {
            $this->info(__("flashcards.main_menu"));
            $this->info('---------');
            $this->info('1. ' . __("flashcards.create_flashcard"));
            $this->info('2. ' . __("flashcards.list_flashcards"));
            $this->info('3. ' . __("flashcards.practice_flashcards"));
            $this->info('4. ' . __("flashcards.stats"));
            $this->info('5. ' . __("flashcards.reset"));
            $this->info('6. ' . __("flashcards.exit"));

            $choice = $this->ask(__("flashcards.enter_choice"));

            switch ($choice) {
                case '1':
                     $this->createFlashcard();
                    break;
                case '2':
                     $this->listFlashcards();
                    break;
                case '3':
                     $this->practiceFlashcards();
                    break;
                case '4':
                     $this->displayStats();
                    break;
                case '5':
                    $this->resetProgress();
                    break;
                case '6':
                    $this->info(__("flashcards.exit_program"));
                    break;
                default:
                    $this->error(__("flashcards.invalid_choice"));
            }

            $this->line('');
        }
    }

    private function resetProgress()
    {
    }

    private function displayStats()
    {
    }

    private function practiceFlashcards()
    {
    }

    private function listFlashcards()
    {
    }

    private function createFlashcard()
    {
    }
}
