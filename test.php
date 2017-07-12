<?php

function vardumpWithPre(array $arr){
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
}
/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 06.07.17
 * Time: 16:57
 */
//function vardumpWithPre(array $arr){
//    echo '<pre>';
//    var_dump($arr);
//    echo '</pre>';
//}
//?>
<!--<div>-->
<!--    <form method="get" action="test.php">-->
<!--        <input type="text" name="numberOfCars"></br>-->
<!--        <input type="text" name='car' >-->
<!--        <input type="submit" name="submit"></br>-->
<!--        <input type="submit" name="stop" value="stop"></br>-->
<!--    </form>-->
<!--</div>-->
<!---->
<?php

vardumpWithPre($__SERVER);


//$cars =[];
//if (isset($_GET['submit'])) {
//    echo $_GET['car'];
//    $cars[]=$_GET['car'];
//    vardumpWithPre($cars);
//    if (isset($_GET['stop'])){
//
//    }
//    unset($_GET['car']);
//}
//?>
<!---->
