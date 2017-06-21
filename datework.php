






<?php
$datetimezone= new DateTimeZone('Europe/Sofia');
$begin = new DateTime('first day of this month',$datetimezone);
$end = new DateTime('last day of this month',$datetimezone);
while ($begin <= $end) {
    if ($begin->format('D') == 'Sun'):

        echo $begin->format('d-m-y') . "\n";
        $begin->modify('+7 day');
    else:$begin->modify('+1 day');
    endif;
}
?>

