<?php
$line = trim(fgets(STDIN));
$nums = explode(" ",$line);
$nums = array_map("intval",$nums);
$data = [];
$sequences = [];
$counter=1;
for($i = 0; $i < (count($nums)); ++$i)
{
    if(count($nums)==1)
    {
        $sequences[]=$data=array('element'=>$nums[$i],'cout'=>$counter);break;}
        if($nums[$i] == $nums[$i+1])
        {
            $counter++;
            if($i == (count($nums)-2))
            {
                $sequences[]=$data=array('element'=>$nums[$i],'cout'=>$counter);break;}
        } else{$sequences[]=$data=array('element'=>$nums[$i],'cout'=>$counter);$counter = 1;
        if($i == (count($nums)-2))
        {
            $sequences[]=$data=array('element'=>$nums[$i],'cout'=>$counter);break;};
    }
}
$maxSequens = $sequences[0];
foreach ($sequences as $key){
    //echo $key['element']." => ".$key['cout']."\n";
                if($key['cout'] > $maxSequens['cout']){$maxSequens = $key;}
}
//print_r($sequences);
//print_r($maxSequens);
echo "\n".str_repeat($maxSequens['element']." ",$maxSequens['cout']).PHP_EOL.$maxSequens['cout'].' members' ;

?>