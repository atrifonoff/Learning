<?php
//$myfile = fopen("datework.php", "r") or die("Unable to open file!");
//echo fread($myfile,filesize("datework.php"));
//
//fclose($myfile);
$emptyLineCounter = 0;
$numericFiles = array();
$handle = fopen("forTests.php", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {

        if((trim($line) == NULL)){
            $emptyLineCounter ++;

        }

    }

    fclose($handle);

} else {
    //echo 'error opening the file.';
}

echo 'Empty lines = '.$emptyLineCounter;




