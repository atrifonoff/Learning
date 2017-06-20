<?php

/**
 * Created by PhpStorm.
 * User: angel
 * Date: 19.06.17
 * Time: 20:12
 */
class Battle
{
    const ROUNDS = 10;

    private $playerOne;
    private $playerTwo;
    private $winner;
    private $rounds;


    public function __construct(Player $playerOne,
                                Player $playerTwo,
                                $rounds = self::ROUNDS)
    {
        $this ->playerOne = $playerOne;
        $this ->playerTwo = $playerTwo;
        $this ->rounds = $rounds;


    }

    public function start()
        {
            $rounds = $this ->rounds;
            $player1 = $this ->playerOne;
            $player2 = $this ->playerTwo;
            while ($rounds > 0  && $player1 ->isAlive() && $player2 ->isAlive())
                {
                    $player1->attack($player2);
                    $player2->attack($player1);

                    $rounds--;
                }
        }


    public function getResult()
    {
        if($this ->playerOne ->isAlive() == $this ->playerTwo ->isAlive())
        {
           return null;exit;
        }
        $winner = $this ->playerOne ->isAlive()
            ? $this ->playerOne
            : $this ->playerTwo;

        return $winner;

    }

}