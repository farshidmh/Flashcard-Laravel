<?php


namespace Tests\Feature;

use App\Actions\DeleteAllFlashCardAction;
use App\Actions\GetAllFlashCards;
use App\Actions\GetAllFlashCardsCountAction;
use App\Actions\GetCountAnsweredFlashcardsAction;
use App\Actions\GetCountCorrectAnsweredFlashcardsAction;
use App\Actions\GetFlashCardByIdAction;
use App\Actions\GetFlashCardByQuestion;
use App\Actions\GetFlashCardCountAction;
use app\Actions\NewFlashCardAction;
use App\Actions\ResetFlashCardAnswerAction;
use App\Actions\SubmitFlashCardAnswerAction;
use App\Models\FlashCard;
use App\Repositories\Interfaces\FlashcardRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseFlashCardActionsTest extends TestCase
{

    use RefreshDatabase;

    private $repository;
    private $question;
    private $answer;
    private $caseSensitive;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = app(FlashcardRepository::class);

        $this->question = 'What is the capital of Canada?';
        $this->answer = 'Ottawa';
        $this->caseSensitive = true;
    }

    public function test_can_create_flashcard()
    {
        $action = new NewFlashCardAction($this->repository);
        $result = $action->execute($this->question, $this->answer, $this->caseSensitive);

        $this->assertInstanceOf(FlashCard::class, $result);
        $this->assertEquals($this->question, $result->question);
        $this->assertEquals($this->answer, $result->answer);
        $this->assertEquals($this->caseSensitive, $result->answer_case_sensitive);
    }

    public function test_get_flashcard_by_id()
    {
        $action = new NewFlashCardAction($this->repository);
        $result = $action->execute($this->question, $this->answer, $this->caseSensitive);

        $action = new GetFlashCardByIdAction($this->repository);
        $result = $action->execute($result->id);

        $this->assertInstanceOf(FlashCard::class, $result);
        $this->assertEquals($this->question, $result->question);
    }

    public function test_get_flashcard_by_question()
    {
        $action = new NewFlashCardAction($this->repository);
        $action->execute($this->question, $this->answer, $this->caseSensitive);

        $action = new GetFlashCardByQuestion($this->repository);
        $result = $action->execute($this->question);

        $this->assertInstanceOf(FlashCard::class, $result);
        $this->assertEquals($this->question, $result->question);
    }

    public function test_get_flashcard_count()
    {
        $action = new NewFlashCardAction($this->repository);
        $action->execute($this->question, $this->answer, $this->caseSensitive);

        $action = new GetFlashCardCountAction($this->repository);
        $result = $action->execute();

        $this->assertIsInt($result);
        $this->assertEquals(1, $result);
    }

    public function test_get_all_flashcard()
    {
        $action = new NewFlashCardAction($this->repository);
        $action->execute($this->question, $this->answer, $this->caseSensitive);
        $action->execute('What is the capital of UK?', 'London', $this->caseSensitive);

        $action = new GetAllFlashCards($this->repository);
        $result = $action->execute();

        $this->assertEquals(2, $result->count());
        $this->assertInstanceOf(FlashCard::class, $result->first());
        $this->assertEquals($this->question, $result->first()->question);
        $this->assertEquals('London', $result->last()->answer);
        $this->assertEquals($this->caseSensitive, $result->last()->answer_case_sensitive);
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function test_submit_correct_answer_case_sensitive()
    {
        $action = new NewFlashCardAction($this->repository);
        $flashCard = $action->execute('What is the capital of UK?', 'London', true);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $result = $action->execute(1, $flashCard->id, 'London');

        $this->assertTrue($result);
    }

    public function test_submit_wrong_answer_case_sensitive()
    {
        $action = new NewFlashCardAction($this->repository);
        $flashCard = $action->execute('What is the capital of UK?', 'London', true);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $result = $action->execute(1, $flashCard->id, 'london');

        $this->assertFalse($result);
    }

    public function test_submit_correct_upper_answer_case_insensitive()
    {
        $action = new NewFlashCardAction($this->repository);
        $flashCard = $action->execute('What is the capital of UK?', 'London', false);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $result = $action->execute(1, $flashCard->id, 'London');

        $this->assertTrue($result);
    }

    public function test_submit_correct_lower_answer_case_insensitive()
    {
        $action = new NewFlashCardAction($this->repository);
        $flashCard = $action->execute('What is the capital of UK?', 'London', false);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $result = $action->execute(1, $flashCard->id, 'london');

        $this->assertTrue($result);
    }

    public function test_submit_wrong_answer_case_insensitive()
    {
        $action = new NewFlashCardAction($this->repository);
        $flashCard = $action->execute('What is the capital of UK?', 'London', false);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $result = $action->execute(1, $flashCard->id, 'France');

        $this->assertFalse($result);
    }

    public function test_count_answered()
    {
        $action = new NewFlashCardAction($this->repository);
        $flashCard = $action->execute('What is the capital of UK?', 'London', false);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $action->execute(1, $flashCard->id, 'France');

        $action = new GetCountAnsweredFlashcardsAction($this->repository);
        $answeredCount = $action->execute(1);

        $this->assertEquals(1, $answeredCount);
    }

    public function test_count_correct_answered()
    {
        $action = new NewFlashCardAction($this->repository);

        $flashCard1 = $action->execute('What is the capital of UK?', 'London', false);
        $flashCard2 = $action->execute('What is 2x2', '4', false);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $action->execute(1, $flashCard1->id, 'London');
        $action->execute(1, $flashCard2->id, '4');

        $action = new GetCountCorrectAnsweredFlashcardsAction($this->repository);
        $answeredCount = $action->execute(1);

        $this->assertEquals(2, $answeredCount);
    }

    public function test_count_all_flashcards()
    {
        $action = new NewFlashCardAction($this->repository);
        $action->execute('What is the capital of UK?', 'London', false);
        $action->execute('What is 2x2', '4', false);

        $action = new GetAllFlashCardsCountAction(new GetAllFlashCards($this->repository));
        $this->assertEquals(2, $action->execute());
    }

    public function test_reset_answers()
    {
        $action = new NewFlashCardAction($this->repository);
        $flashCard1 = $action->execute('What is the capital of UK?', 'London', false);
        $flashCard2 = $action->execute('What is 2x2', '4', false);

        $action = new SubmitFlashCardAnswerAction($this->repository);
        $action->execute(1, $flashCard1->id, 'London');
        $action->execute(1, $flashCard2->id, '4');


        $action = new ResetFlashCardAnswerAction($this->repository);
        $action->execute(1);

        $action = new GetCountAnsweredFlashcardsAction($this->repository);
        $answeredCount = $action->execute(1);

        $this->assertEquals(0, $answeredCount);
    }

    public function test_all_flashcards()
    {
        $action = new NewFlashCardAction($this->repository);
        $action->execute('What is the capital of UK?', 'London', false);
        $action->execute('What is 2x2', '4', false);


        $action = new DeleteAllFlashCardAction($this->repository);
        $action->execute();

        $action = new GetAllFlashCardsCountAction(new GetAllFlashCards($this->repository));
        $this->assertEquals(0, $action->execute());
    }


}
