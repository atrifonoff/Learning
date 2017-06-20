<?php

require_once 'Player.php';
require_once 'Battle.php';

?>

<form>

   Player 1 name:  <input type="text" name="player_one_name" /><br>
    Player 2 name:  <input type="text" name="player_two_name" /><br>
    <input type="submit" name="start" value="Start Battle">


</form>


    <?php
if(isset($_GET['start']))
{
    $player1 = new Player($_GET['player_one_name']);
    $player2 = new Player($_GET['player_two_name']);
    $battle = new Battle($player1,$player2);
    $battle ->start();

    if($battle ->getRsult() === null)
    {
        echo 'Drow battle !';
    } else{ echo 'The winner is: '.$battle ->getRsult() ->getName();}
}

