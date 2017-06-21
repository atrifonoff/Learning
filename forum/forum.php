<?php

/**
 * Created by PhpStorm.
 * User: angel
 * Date: 20.06.17
 * Time: 23:02
 */
class Forum
{

    /**
     * @var User[]
     */
    private $usersById = [];


    /**
     * @var User[]
     */

    private $usersByUsername = [];

    /**
     * @var Question[]
     */
    private $questions = [];

    /**
     * @var Answer[]
     */
    private  $answers = [];

    /**
     * @var Answer[]
     */
    //private $comments = [];

    /**
     * @var User
     */
    private $curentUser;

    public function start()
    {
        while (true)
        {
            $line = trim(fgets(STDIN));
            $commandArgs = explode(" ",$line);
            $commandName = $commandArgs[0];
            switch ($commandName){
                case "register":
                    $this ->register(
                        $commandArgs[1],
                        $commandArgs[2]
                    );
                    break;
                case "login":
                    $this ->login(
                        $commandArgs[1],
                        $commandArgs[2]
                    );
                    break;
                case "ask":
                    $this ->ask(
                        $commandArgs[1],
                        $commandArgs[2]
                    );
                    break;
                case "answer":
                    $this ->answer(
                        intval($commandArgs[1]),
                        $commandArgs[2]
                    );
                    break;
//                case "comment":
//                    $this ->comment(
//                        intval($commandArgs[1]),
//                        $commandArgs[2]
//                    );
//                    break;
                case "show":
                    $this ->show();
                    break;
                default:
                    break;
            }

        }
    }

    public function register($username,$password)
    {
        if(array_key_exists($username,$this ->usersByUsername))
        {
            throw new Exception('Username already exist');
        }

        $user = new User($username, $password);
        $this ->usersById[$user ->getId()] =$user;
        $this ->usersByUsername[$username] = $username;

    }

    public function login($username,$pssword)
    {
        if(!array_key_exists($username,$this ->usersByUsername))
        {
            throw new Exception('Username does not exist');
        }
        $user = $this ->usersByUsername[$username];
        $userPassword = $user ->getPassword();
        if($userPassword != $pssword){
            throw new Exception('Password missmatch');
        }
        $this ->curentUser = $user;

    }

    public function ask($title,$body)
    {
        if(!$this ->curentUser){
            throw new Exception('Anonimus qustion asking is nod alound');
        }
        $question = new Question($title, $body, $this ->curentUser);
        $this ->questions[$question ->getId()] = $question;

    }

    public function answer($questionId,$body)
    {

        if(!$this ->curentUser){
            throw new Exception('Anonimus  answering is nod alound');
        }
        if(!array_key_exists($questionId, $this ->questions)){
            throw new Exception('Invalid question to answer');
        }

        $answer = new Answer($body, $this ->curentUser, $this ->questions[$questionId]);
        $this ->answers[$answer ->getId()] = $answer;

    }

//    public function comment($answerId,$body)
//    {
//
//        if(!$this ->curentUser){
//            throw new Exception('Anonimus  commenting is nod alound');
//        }
//
//        if(!array_key_exists($answerId, $this ->answers)){
//            throw new Exception('Answer does not exist');
//        }
//
//        $answer = $this ->answers[$answerId];
//        $comment = new Answer($body, $this ->curentUser);
//
//    }

    public function show()
    {

    }


}