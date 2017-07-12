<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 05.07.17
 * Time: 18:03
 */

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