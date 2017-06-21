<?php

/**
 * Created by PhpStorm.
 * User: angel
 * Date: 20.06.17
 * Time: 15:21
 */
class User
{
        private static $lastid;

        private $id;
        private $username;
        private $password;

    /**
     * @var array Question[]
     */

    /* зададени въпроси */
        private $questions = [];

    /**
     * @var array Answer[]
     */
    /* отговори */
        private $answers = [];

    /**
     * @var Answer[]
     */
    /// коментари
        private $comments = [];

    /**
     * User constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this ->id = ++self::$lastid;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        if(!preg_match("/[0-9]+/",$password)){
            throw new Exception('Password should contain digits');
        }
        if(!preg_match("/[a-z]+/",$password)){
            throw new Exception('Password should contain letters');
        }
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getQuestions()
    {
        return $this->questions;
    }


    /**
     * @param Question $question
     * Метод за създаване на въпроси от потребителя и ги вкарва в масива qustions[]
     */
    public function askQuestion(Question $question)
    {
        $this ->questions[] = $question;
    }


    /**
     * @return array
     *
     * метода получава отговор
     */
    public function getAnswers()
    {
        return $this ->answers;
    }

    /**
     * Метод за даване на отговор на въпрос.
     * Параметрите са : оговори на въпрос ($question)  с (отговор $answer)
     */

    public function answer(Question $question, Answer $answer)
    {
        $this ->answers[] = $answer; /* отговора $answer влиза в масива */
        $question ->answer($answer);  /* въпроса получава отговора , който е влязъл като параметър $answer на функцията answeer() */
    }

    /**
     * @return Answer[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    public function comment(Answer $comment, Answer $answer)
    {
        $this ->comments[] = $comment;
        $answer ->comment($comment);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



}
