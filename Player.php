<?php


class Player
{
    private static $lastid;


    private $id;
    private $name;
    private $healt;
    private $attack;

    public function __construct( $name)
    {
        $this ->name = $name;
        $this ->healt = rand(20 , 60);
        $this ->attack = rand(1 , 8);
        $this ->id = ++self::$lastid;

    }

    /* Връща живота на играча (healt getter) */
    public function getHealt()
    {
        return $this->healt;
    }


    /* Връща името на играча (name getter) */
    public function getName()
    {
        return $this->name;
    }



    /* Връща ID на играча (ID getter) */
    public function getId()
    {
        return $this->id;
    }

    /* Връща стойността на силата на атаката т.е. стойността,
     с която намалява живота на атакувания (attack getter) */
    public function getAttack()
    {
        return $this ->attack;
    }


    /* Намалява живота на атакуващия със стойността на аргумента $healt */
    public function reduceHelt($healt)
    {
        $this ->healt -=$healt;
    }

    /* Показва дали играча все още е жив */
    public function isAlive()
    {
        return $this ->healt > 0;
    }

    /* Атака насочена срещу играча идентефициран с аргумента на функцията $player.
    Живота на атакувания се намалява със силата ($attak) на атакуващия.
    Фиксира защита срещу самоубийство */
    public function attack(Player $player)
    {
        if($player ->getId() == $this ->getId())
        {
            throw new Exception('Cannot attack yourself!');
        }
        $player ->reduceHelt($this ->getAttack());
    }
}
