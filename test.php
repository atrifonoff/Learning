<?php
//$myfile = fopen("datework.php", "r") or die("Unable to open file!");
//echo fread($myfile,filesize("datework.php"));
//
//fclose($myfile);

function vardumpWithPre(array $arr){
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
}
function printrWithPre(array $arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}


$arr[] = (array(1,2,3,4,5,6));


foreach($arr[0] as  $m) {

    if(strtolower(trim($m->class)) != strtolower(trim($className))) {

        unset($methods[0][$id]);

    }

}

vardumpWithPre($arr);
printrWithPre($arr);



?>