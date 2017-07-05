<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 05.07.17
 * Time: 22:32
 */

class drink
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