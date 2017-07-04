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
    private $comments = [];

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

                case "comment":
                    $this ->comment(
                        intval($commandArgs[1]),
                        $commandArgs[2]
                    );
                    break;
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
        $this ->usersByUsername[$username] = $user;

    }

    public function login($username,$password)
    {
        if(!array_key_exists($username,$this ->usersByUsername))
        {
            throw new Exception('Username does not exist');
        }
        $user = $this ->usersByUsername[$username];
        $userPassword = $user ->getPassword();
        if($userPassword != $password){
            throw new Exception('Password missmatch');
        }
        $this ->curentUser = $user;

    }

    /**
     * @param $title
     * @param $body
     * @throws Exception
     */
    public function ask($title,$body)
    {
        if(!$this ->curentUser){
            throw new Exception('Anonimus qustion asking is nod alound');
        }
        $question = new Question($title, $body, $this ->curentUser);
        $this ->questions[$question ->getId()] = $question;
        $this ->curentUser ->askQuestion($question);

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
        $this ->curentUser ->$answer( $this ->questions[$questionId]);

    }

    public function comment($answerId,$body)
    {

        if(!$this ->curentUser){
            throw new Exception('Anonimus  commenting is nod alound');
        }

        if(!array_key_exists($answerId, $this ->answers)){
            throw new Exception('Answer does not exist');
        }

        $answer = $this ->answers[$answerId];
        $qestion = $answer ->getQuestion();

        $comment = new Answer($body, $this ->curentUser,$qestion,$answer);
        $this ->comments[$comment ->getId()] = $comment;
        $this ->curentUser ->comment($comment,$answer);

    }

    public function show()
    {
        foreach ($this ->questions as $question)
        {
            echo "  --Question Title: ".$question ->getTitle()." Body:".$question ->getBody()."Autor: ".$question ->getAutor() ->getUsername(). PHP_EOL;
           foreach ($question ->getAnswers() as $answer){
               echo "      --- Answer Body: ".$answer ->getBody()." Autor: ".$answer ->getAutor() ->getUsername().PHP_EOL;
               foreach ($answer ->getComments() as $comment){
                   echo "            --- Comment Body: ".$answer ->getBody()." Autor: ".$answer ->getAutor() ->getUsername().PHP_EOL;

               }
           }
        }

    }


}