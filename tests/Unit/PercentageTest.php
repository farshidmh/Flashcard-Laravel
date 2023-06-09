<?php

namespace Tests\Unit;

use App\Actions\CalculatePercentageAction;
use PHPUnit\Framework\TestCase;

class PercentageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_correct_percentage()
    {
        $action = new CalculatePercentageAction();
        $result = $action->execute(15, 1);

        $this->assertIsFloat($result);
        $this->assertEquals(6.67,$result);
    }
}
