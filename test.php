<?php
//$myfile = fopen("datework.php", "r") or die("Unable to open file!");
//echo fread($myfile,filesize("datework.php"));
//
//fclose($myfile);
$emptyLineCounter = 0;
$handle = fopen("datework.php", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        if((trim($line == NULL))){
            echo 'empty'.$line."<br>";
            $emptyLineCounter ++;

        }

    }
    fclose($handle);

} else {
    echo 'error opening the file.';}

echo 'Empty lines = '.$emptyLineCounter;




