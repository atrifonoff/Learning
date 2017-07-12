<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 05.07.17
 * Time: 11:49
 */

class Currency
{
    private $rate;

    private $amount;

    /**
     * Currency constructor.
     * @param $rate
     * @param $amount
     */
    public function __construct($rate, $amount)
    {
        $this->rate = $rate;
        $this->amount = $amount;
    }


}


class BGN extends Currency
{


}


class USD extends Currency
{

}

class Fuel
{
    private $weight;

    /**
     * @var Currency
     */
    private $price;

    protected function setWeight($weight) // с модификатор protkted се указва ,
                                             // че функциятa е достъпна само
                                                // за децата//
    {
        $this->weight = $weight;
    }

    /**
     * @param mixed $price
     */
    protected function setPrice( $price)
    {
        if ($price < 0){
            throw new Exception('The price could not be negative');
        }

        $this->price = $price;
    }


    /**
     * Fuel constructor.
     * @param $weight
     * @param $price
     */
    public function __construct($weight,$price)
    {
        $this->setWeight($weight);
        $this->setPrice($price);
    }


    public function getWeight()
    {
        return $this ->weight;
    }

    public function getPrice()
    {
        return $this->price;
    }






}

class Gas extends Fuel
{


    private $pressure;

    public function __construct($weight, $price,$pressure)
    {
        parent::__construct($weight, $price);
        $this->setPressure($pressure);
    }

    /**
     * @param mixed $pressure
     */
    public function setPressure($pressure)
    {
        $this->setWeight(                         //понеже setWeight-а е protekted , това позволява да се одработва от децата//
        $this->getWeight() + (0.5* $pressure));
        $this->pressure = $pressure;

    }

    /**
     * @return mixed
     */
    public function getPressure()
    {
        return $this->pressure;
    }

   protected function setPrice($price)    // over write  на базовия клас setPrice с добавка на поведение//
    {
        $price = $price *1.2;
        parent::setPrice($price);

    }

}

$fuels = [];
$fuels[0] = new Fuel(10,20);
$fuels[1] = new Gas(5,7,32);
///var_dump($fuels);

echo "fuels:"."<PRE>";
print_r($fuels);
    echo "<PRE/>";

exit;