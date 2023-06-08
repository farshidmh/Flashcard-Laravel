<?php

namespace App\Console\Commands;

use App\Actions\CalculateCompletionPercentageAction;
use App\Actions\GetAllFlashCards;
use App\Actions\GetAllFlashCardsAndUsersAnswerAction;
use App\Actions\GetFlashCardByIdAction;
use App\Actions\SubmitFlashCardAnswerAction;
use App\Repositories\Interfaces\FlashcardRepository;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class PracticeFlashcardCommand extends Command
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
    protected $signature = 'flashcard:practice';

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
        CalculateCompletionPercentageAction  $calculateCompletionPercentageAction,
        GetAllFlashCardsAndUsersAnswerAction $getAllFlashCards,
        GetFlashCardByIdAction               $getFlashCardById,
        SubmitFlashCardAnswerAction          $submitFlashCardAnswer,

    )
    {
        do {
            $this->displayProgress($calculateCompletionPercentageAction, $getAllFlashCards);

            $this->info(__('flashcards.exit_with_zero'));

            $flashcardId = $this->ask(__('flashcards.practice_flash_card_id'));

            if($flashcardId == 0) {
                break;
            }

            try {
                $flashcard = $getFlashCardById->execute($flashcardId);

                $answer = $this->ask($flashcard->question . ($flashcard->answer_case_sensitive ? ' (case sensitive)' : ''));

                $status = $submitFlashCardAnswer->execute($this->userId, $flashcardId, $answer);


                if ($status) {
                    $this->info(__('flashcards.correct_answer'));
                } else {
                    $this->error(__('flashcards.incorrect_answer'));
                }

                $this->displayProgress($calculateCompletionPercentageAction, $getAllFlashCards);
                $this->line('================');
            } catch (\Exception $e) {
                $this->error(__('flashcards.flashcard_not_found'));
            }
        } while ($this->confirm(__('flashcards.practice_more')));

        return CommandAlias::SUCCESS;
    }

    private function displayProgress($calculateCompletionPercentageAction, $getAllFlashCards): void
    {
        $flashcards = $getAllFlashCards->execute($this->userId);

        $headers = [
            __('flashcards.flashcard_table_id'),
            __('flashcards.flashcard_table_question'),
            __('flashcards.flashcard_table_user_answer'),
            __('flashcards.flashcard_table_status'),
        ];

        $rows = [];

        foreach ($flashcards as $flashcard) {

            $status = __('flashcards.not_answered');

            if (!is_null($flashcard->answer_status)) {
                $status = ($flashcard->answer_status) ? __('flashcards.correct') : __('flashcards.incorrect');
            }

            $rows[] = [
                $flashcard->id,
                $flashcard->question,
                $flashcard->user_answer,
                $status,
            ];
        }

        $completionPercentage = $calculateCompletionPercentageAction->execute($flashcards);

        $this->table($headers, $rows);

        $this->line('');
        $this->info(__('flashcards.progress_completion', ['percentage' => $completionPercentage]));
        $this->line('');
    }

}
