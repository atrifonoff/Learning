<?php

require_once 'Player.php';
require_once 'Battle.php';

?>

<form method="get" action="index.php" title=" " >

   Player 1 name:  <input type="text" name="player_one_name" title="" /><br>
    Player 2 name:  <input type="text" name="player_two_name" title="" /><br>
    <input type="submit" name="start" value="Start Battle">


</form>


    <?php
if(isset($_GET['start']))
{
    $player1 = new Player($_GET['player_one_name']);
    $player2 = new Player($_GET['player_two_name']);
    $battle = new Battle($player1,$player2);
    $battle ->start();

    if($battle ->getResult() === null)
    {
        echo 'Drow battle !';
    } else{ echo 'The winner is: '.$battle ->getResult() ->getName();}
}

