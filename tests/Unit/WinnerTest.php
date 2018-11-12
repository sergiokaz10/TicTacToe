<?php

namespace Tests\Feature;

use App\Services\Match;
use Tests\TestCase;

class WinnerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItReturnsNumberTwoWinnerOnTheDiagonal()
    {
        $board =[
            2, 1, 2,
            0, 2, 1,
            0, 1, 2,
        ];

        $winner = Match::hasWinner($board);
        $this->assertEquals(2, $winner);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItReturnsNumberTwoWinnerOnTheRow()
    {
        $board =[
            1, 0, 1,
            0, 1, 0,
            2, 2, 2,
        ];

        $winner = Match::hasWinner($board);
        $this->assertEquals(2, $winner);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItReturnsNumberTwoWinnerOnTheColumn()
    {
        $board =[
            1, 2, 1,
            0, 2, 0,
            0, 2, 1,
        ];

        $winner = Match::hasWinner($board);
        $this->assertEquals(2, $winner);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItReturnsNumberOneWinnerOnTheDiagonal()
    {
        $board =[
            1, 2, 1,
            0, 1, 2,
            0, 2, 1,
        ];

        $winner = Match::hasWinner($board);
        $this->assertEquals(1, $winner);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItReturnsNumberOneWinnerOnTheColumn()
    {
        $board =[
            2, 2, 1,
            0, 1, 1,
            0, 2, 1,
        ];

        $winner = Match::hasWinner($board);
        $this->assertEquals(1, $winner);
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItReturnsNumberOneWinnerOnTheRow()
    {
        $board =[
            2, 2, 1,
            1, 1, 1,
            0, 2, 0,
        ];

        $winner = Match::hasWinner($board);
        $this->assertEquals(1, $winner);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItReturnsNonWinner()
    {
        $board =[
            2, 2, 1,
            1, 0, 1,
            0, 2, 0,
        ];

        $winner = Match::hasWinner($board);
        $this->assertEquals(0, $winner);
    }

}
