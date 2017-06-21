<?php

/**
 * Created by PhpStorm.
 * User: angel
 * Date: 20.06.17
 * Time: 16:03
 */
class Answer
{

    const BODY_MIN_LENGHT = 7;

    private static $lastid;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $body;

    /**
     * @var User
     */
    private $autor;

    /**
     * @var Question
     */
    private $question;

    /**
     * @var Answer
     */
    private $answer;

    /**
     * @var Answer
     */
    private $comments = [];

    /**
     * Answer constructor.
     * @param $body
     * @param User $autor
     * @param Question $question
     * @param Answer|null $answer
     */

    public function __construct($body,
                                User $autor,
                                Question $question,
                                Answer $answer = null)
    {
        $this ->setBody($body);
        $this ->setAutor($autor);
        $this ->setQuestion($question);
        $this ->setAnswer($answer);
        $this ->id = ++self::$lastid;
    }


    /**
     * @return string
     */
    public function getBody()
    {

        return $this->body;
    }

    /**
     * @return User
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        if(strlen($body) < self::BODY_MIN_LENGHT){
            throw new Exception('Body is too short');
        }
        $this->body = $body;
    }

    /**
     * @param User $autor
     */
    public function setAutor(User $autor)
    {
        $this->autor = $autor;
    }

    /**
     * @param Question $question
     */
    public function setQuestion(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @param Answer $answer
     */
    public function setAnswer(Answer $answer = null)
    {
        $this->answer = $answer;
    }

    public function comment(Answer $answer)
    {
        $this ->comments[] = $answer;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Answer
     */
    public function getComments()
    {
        return $this->comments;
    }



}