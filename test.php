
<form method="get" onsubmit="">

    <input type="text" name="data" />
    <br>
    <input type="text" name="coll" />
    <input type="submit" value="colls"/>
</form>

<?php
if(isset($_GET['coll'])):
    $data=explode(' ',$_GET['data']);
     $elementCount=count($data);
    $i=0;
    $colls=($_GET['coll']-1);
    $rows=ceil($elementCount/($colls+1));

    for($r=0;$r<=$rows-1;$r++){
        for($c=0;$c<=$colls;$c++){

            $array[$r][$c]=$data[$i];
            $i++;
            if($i>=$elementCount){$i=0;echo '<br>'; break;}
        }
    }
    echo '<pre>';
    print_r($array);
    //var_dump($array);
    echo '</pre>';

    echo 'elementCount= '.$elementCount.'<br>';
        echo 'rows= '.$rows.'<br>';

    for($r=0;$r<=$rows-1;$r++){
        for($c=0;$c<=$colls;$c++){

            echo $array[$r][$c].' ';

            if($c==($colls)){echo '<br>';}
            $i++;
            if($i>=$elementCount){$i=0;echo '<br>'; break;}
        }
    }

    foreach ($array as $row){
        foreach ($row as $coll){
            if(strlen($coll)>5):echo $coll.'<br>';endif;
        }
    }

endif;

?>