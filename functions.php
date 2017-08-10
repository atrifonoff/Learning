<?php

/* Делларираме ,че типовете на променливите ще бъдат  стриктни.
задължително се делкарират типовете на променливите. При несъответатвие връща грешка
Работи с PHP 7 и нагоре*/

// declare(strict_types=1);


/* Декларирам си функции за по -добра визия при отпечатване на масиви  */

function printrWithPre(array $arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
function vardumpWithPre(array $arr){
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
}


/* Деклариране на функция която търси в масив */


//$names=['john','smith','maria'];
//
//function contains(array $arrayTosearch,$searchedValue):bool {
//
//    $nameExist=false;
//    foreach ($arrayTosearch as $value){
//        if($value==$searchedValue):
//            $nameExist=true;break;
//        endif;
//    }
//   return $nameExist;
//}

//var_dump(contains($names,'john'));


/* Деклариране на функция за събиране на две числа , които се въвеждат от HTML  форма
Правим проверка и валидация на типа на входните данни */


//function sum(int $a,int $b):int {
//    $sum=$a+$b;
//    return $sum;
//}
//
//?>
<!--<form method="get">-->
<!--    <input type="text" name="num1" /><br>-->
<!--    <input type="text" name="num2" />-->
<!--    <input type="submit" name="submit" value="sum" >-->
<!--</form>-->
<?php
//
//    if(isset($_GET['submit'])){
//        $a= filter_var($_GET['num1'],FILTER_VALIDATE_INT);
//        $b= filter_var($_GET['num2'],FILTER_VALIDATE_INT);
//      if($a===false || $b===false){echo 'Invalid number type';}
//    else{ echo sum($a,$b).'<br>';}
//?>




<!--        <form method="get">-->
<!--            <input type="text" name="num" />-->
<!--            <input type="submit" name="submit" value="sum" >-->
<!--        </form>-->
<?php

/*Деклариране на функция , която проверява число дали е четно
 с проверка и валидация int  */


//function isEven(int $numberForChech):bool {
//    return $numberForChech % 2 == 0;
//}
//    if(isset($_GET['submit'])) {
//    if (filter_var($_GET['num'], FILTER_VALIDATE_INT)) {
//        echo("Variable is an integer"."<br>");
//        $result = isEven(filter_var($_GET['num'],FILTER_VALIDATE_INT));
//        if ($result == true) {
//            echo 'The number is even';
//        } else {
//            echo 'The number is odd';
//        }
//
//    }
//    else {
//        echo("Variable is not an integer");
//    }
//}

/* Деклриране на функция , която сравнявява два стринга. Ако има незадължителен трети параметър true
функцията е Caseignor . Ако не е въведен трети параметър е case sensitive. */

//function stringEqals(string $str1,string $str2, $ignorCase=false){
//
//    if($ignorCase == true){
//        return ($str1) === strtolower($str2);
//    }
//    return $str1 === $str2;
//}
//
//
//var_dump(stringEqals('pesho','pEsho',true));

//$nums=[45,1,34,2,555,10,123,35,231,100];
//
//usort($nums, function($num1,$num2){
//    return $num2<$num1;
//});
//printrWithPre($nums);

//$people = [
//
//                [
//                    'name' => 'pesho',
//                    'age' => 24
//                ],
//                [
//                    'name' => 'gosho',
//                    'age' => 18
//                ],
//                [
//                    'name ' =>'ani',
//                    'age' => 18
//                ],
//           ];
//usort($people, function($a,$b){
//   $ageCompare = $a['age']<=>$b['age'];
//    if($ageCompare === 0){
//        return $b['name']<=> $a['name'];
//        return $ageCompare;
//    }
//
//
//});
//printrWithPre($people);
//vardumpWithPre($people);

$names=['pesho','gosho','maria','penka','profan','mincho','pechka','katia'];

$result = [];
foreach ($names as $name){
    if($name[0] == 'p'){
        $result[]=$name;
    }
}
$countArr = count($result);
printrWithPre($result);
echo '<br>';
echo '<li>'.'Members of result'.$countArr;

?>