<?php

namespace Database\Seeders;

use App\Models\FlashCard;
use Illuminate\Database\Seeder;

class FlashCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $flashcards = [
            [
                'question' => 'What is the capital of France?',
                'answer' => 'Paris',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'What is the largest planet in our solar system?',
                'answer' => 'Jupiter',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'What is the capital of Australia?',
                'answer' => 'Canberra',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'Who wrote the novel "Pride and Prejudice"?',
                'answer' => 'Jane Austen',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'What is the chemical symbol for the element gold?',
                'answer' => 'Au',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'In which year did World War II end?',
                'answer' => '1945',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'What is the tallest mountain in the world?',
                'answer' => 'Mount Everest',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'Who painted the Mona Lisa?',
                'answer' => 'Leonardo da Vinci',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'What is the currency of Japan?',
                'answer' => 'Japanese yen',
                'answer_case_sensitive' => false,
            ],
            [
                'question' => 'What is the largest organ in the human body?',
                'answer' => 'Skin',
                'answer_case_sensitive' => false,
            ],
            [
                'question' => 'Who is the current President of the United States?',
                'answer' => 'Joe Biden',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'What is the national animal of Canada?',
                'answer' => 'Beaver',
                'answer_case_sensitive' => true,
            ],
            [
                'question' => 'What is 1+1',
                'answer' => '2',
                'answer_case_sensitive' => false,
            ],
            [
                'question' => 'What is 2x3',
                'answer' => '6',
                'answer_case_sensitive' => false,
            ],
            [
                'question' => 'What is 3x5',
                'answer' => '15',
                'answer_case_sensitive' => false,
            ],
            
        ];

        foreach ($flashcards as $flashcard) {
            FlashCard::create($flashcard);
        }

    }
}
