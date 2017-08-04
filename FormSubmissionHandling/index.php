<form action="operations/edit.php?id=1" method="post">
    Username: <input type="text" name="username"/><br/>
    Password: <input type="password" name="password"/><br/>
    <input type="submit" value="Edit!"/>
</form>
<hr/>
<form action="operations/edit.php?id=2" method="post">
    Username: <input type="text" name="username"/><br/>
    Password: <input type="password" name="password"/><br/>
    <input type="submit" value="Edit!"/>
</form>
<!--<form>-->
<!--    <input type="text" name="redirect"/>-->
<!--    <input type="submit"/>-->
<!--</form>-->
<?php
//if (isset($_GET['redirect'])) {
//    header("Location: " . $_GET['redirect']);
//}