<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 03.07.17
 * Time: 22:41
 */

class User
{
    private $username;
    private $password;

    /**
     * User constructor.
     * @param $userName
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->setUsername($username);
        $this ->setPassword($password);
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        if (!preg_match("/[0-9]+/",$password)){
        throw new Exception('Password schould contain digits');
    }
        if (!preg_match("/[a-z]+/",$password)){
            throw new Exception('Password schould contain small letters');
        }
        $this->password = $password;
    }

    public function setUsername($username)
    {
        $this ->username = $username;
    }

}

class Forum
{
    public $users = [];

    public function start()
    {

        while (true)
        {
            $cmdLine = trim(fgets(STDIN));
            $cmdTokens = explode(' ',$cmdLine);
            $cmd = $cmdTokens[0];

            switch ($cmd){
                case 'register':

                    $user = new User($cmdTokens[1], $cmdTokens[2]);
                    $this->users[] = $user;
                    var_dump($this ->users);
                    break;

                case 'edit':
                    $index = $cmdTokens[1];
                    $newPassword = $cmdTokens[2];
                    $user = $this ->users[$index];

                    $user ->setPassword($newPassword);
                    var_dump($this ->users);
                    break;
                case 'end':
                    exit;

            }
        }

    }




}

$forum = new Forum();
$forum ->start();
