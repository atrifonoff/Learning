<?php
/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 13.07.17
 * Time: 14:23
 */

//declare(strict_types=1);
?>
    <form>
        <input type="text" name="age[]"/> <br/>
        <input type="text" name="age[]"/> <br/>
        <input type="text" name="age[]"/> <br/>
        ROLE_USER: <input type="checkbox" name="role[]" value="user"/><br/>
        ROLE_MOD: <input type="checkbox" name="role[]" value="moderator"/><br/>
        ROLE_ADMIN: <input type="checkbox" name="role[]" value="administrator"/><br/>
        ROLE_AUTHOR: <input type="checkbox" name="role[]" value="author"/><br/>

        <input type="submit"/>
    </form>

<?php
var_dump($_GET);