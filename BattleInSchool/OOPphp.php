<?php
  //declare(strict_types=1);
//function filter( $array, callable $filteringFunction){
//    $result=[];
//    foreach ($array as $value){
//        if($filteringFunction($value) === true){
//            $result[] = $value;
//        }
//    }
//    return $result;
//}
//
//$a = filter(['sss','dddddd','rrrrr'],function ($e){return strlen($e)>=5;});
//var_dump($a);

//function devide ($a,$b) {
//    if($a < 0 || $b < 0){
//        throw new Exception(" The numbers must be positive");
//    }
//    if($b == 0 ){
//        throw new DivisionByZeroError;
//    }
//    return $a / $b;
//}


/* Малка игричка  в която има двама играчи,
всеки си има животи и атака. При атака от един играч към дуг
ще се отнемат животи, докато някой не остане с нула или по-малко животи*/

/* Играч
  -ИД (пореден номер)
  - Частен(private), Публичен(public), protected  Име
  - private Живот
  - private Атака

Действие
   ** Конструктор (Име, Живот, Атака) (функция)
   *Атакува (друг играч) (функция)
   * намалиЖивот (живот)
   *покажиМиАтакатаНаИграча (играч)
 * живЛиСъм

*/

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

$winner = null;
$round = 10;
$player1 = new Player('Pesho');

$player2 = new Player('Stamat');
echo $player1 ->getName().' healt is: '.$player1 ->getHealt()."\n";
echo $player1 ->getName().' attack is: '.$player1 ->getAttack()."\n";
echo "........................................................\n";

echo $player2 ->getName().' healt is: '.$player2 ->getHealt()."\n";
echo $player2 ->getName().' attack is: '.$player2 ->getAttack()."\n";
echo "........................................................\n";

while ($round > 0  && $player1 ->isAlive() && $player2 ->isAlive())
{
    $player1 ->attack($player2);
    $player2 ->attack($player1);

    $round--;
}
    if($player1 ->isAlive() == $player2 ->isAlive())
    {
        echo 'THE BATTLE IS DROW';exit;
    }
    $winner = $player1 ->isAlive() ? $player1 : $player2;

echo 'THE WINNER IS '.$winner ->getName();

