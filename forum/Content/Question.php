<?php

/**
 * Created by PhpStorm.
 * User: angel
 * Date: 20.06.17
 * Time: 15:40
 */
class Question
{
    const TITLE_MIN_LENGHT = 3;
    const BODY_MIN_LENGHT = 10;

    private static $lastid;

    private $id;
    private $title;
    private $body;
    private $autor;

    /**
     * @var arrayAnswer[]
     */
    private $ansers = [];

    /**
     * Question constructor.
     * @param $title
     * @param $body
     * @param $autor
     */
    public function __construct( $title,
                                 $body,
                                 User $autor)
    {
        $this->setTitle($title);
        $this->setTitle($body);
        $this->setTitle($autor);
        $this ->id = ++self::$lastid;

    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        if(strlen($title > self::TITLE_MIN_LENGHT)){
            throw new Exception('Title is too short');
        }
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        if(strlen($body > self::BODY_MIN_LENGHT)){
            throw new Exception('Body is too short');
        }
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param User $autor
     */
    public function setAutor(User $autor)
    {
        $this->autor = $autor;
    }

    /**
     * @return User
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAnser()
    {
        return $this ->ansers;
    }
    public function answer(Answer $answer)
    {
        $this ->ansers = $answer;
    }

}

/* 20.06.17 16.50 home */