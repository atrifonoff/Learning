
<form method="post">
    <input type="text" name="user" title="">
    <input type="password" name="pass" title="">
    <input type="submit" name="submit">

</form>


<?php
if(isset($_POST['submit'])){
   $user=$_POST['user'];
    $pass=$_POST['pass'];
    if($user=='user' && $pass=='123'){
        session_start();
        $_SESSION['user']=$user;
        header("Location: header.php");
    }else{ echo"Invalid user / pass";}
}
