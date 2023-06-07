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
        $this->info(__('flashcards.welcome'));
        $this->line(__('================'));
        $this->displayMainMenu();
        return CommandAlias::SUCCESS;
    }

    private function displayOptions(): void
    {
        $this->line('---------');
        $this->info(__("flashcards.main_menu"));
        $this->line('---------');
        $this->info('1. ' . __("flashcards.create_flashcard"));
        $this->info('2. ' . __("flashcards.list_flashcards"));
        $this->info('3. ' . __("flashcards.practice_flashcards"));
        $this->info('4. ' . __("flashcards.stats"));
        $this->info('5. ' . __("flashcards.reset"));
        $this->info('6. ' . __("flashcards.exit"));
        $this->line('---------');
    }

    private function choiceRunner($choice)
    {
        switch ($choice) {
            case '1':
                $this->call('flashcard:create');
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
    }

    private function displayMainMenu(): void
    {
        $choice = '';
        while ($choice !== '6') {
            $this->displayOptions();
            $choice = $this->ask(__("flashcards.enter_choice"));
            $this->choiceRunner($choice);
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
}
