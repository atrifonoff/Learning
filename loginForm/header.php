
<?php
session_start();
if(isset($_SESSION['user'])){
    echo "Welkome  ".htmlentities($_SESSION['user']);

}
else{
    echo "Unauthorized access ";
    die;
}


?>

<br>
<h1 style="color: green;">I'm the test php page</h1>
