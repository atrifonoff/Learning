<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 05.07.17
 * Time: 22:32
 */
function vardumpWithPre(array $arr){
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
}




class Drink
{
    private $drinks = [];

    private $taste;
    private $volume;
    private $price;

    public function __construct($taste, $volume, $price)
    {
        $this->setTaste($taste);
        $this->setVolume($volume);
        $this->setPrice($price);

    }

    public function setTaste($taste)
    {
        $this->taste = $taste;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


}


class CarbonetetDrink
{

    private $name;



}


$drink = new Drink('orange','1.5l', '1.80lw');
$drinks[] = $drink;
vardumpWithPre($drinks);