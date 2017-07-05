<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 05.07.17
 * Time: 14:37
 */

interface Mashine
{
    public function getParts();


}

abstract class Vehicle implements Mashine
{
    private $range;

    private $dimension;


public function getRange()
{
    return $this->range;
}


public abstract function drive();

    public function getDimension()
    {
        return $this->dimension;
    }

}

class Car extends Vehicle
{

    public function drive()
    {
        echo 'This is the drive function of car'."\n"."</br>";
    }

    public function getDimension()
    {
        return 4;
    }

      public function getPart($part)
      {

      }
      public function setPart($part)
      {

      }


    public function getParts()
    {

    }


}

class Motorsycle extends Vehicle
{

    public function drive()
    {
        echo 'Motorcycle was driven'."\n"."</br>";
    }

    public function getDimension()
    {
        return 2;
    }
    public function getParts()
    {

    }
    public function getPart($part)
    {

    }
    public function setPart($part)
    {

    }


}

class Printer implements Mashine
{
    public function getParts()
    {

    }
    public function getPart($part)
    {

    }

    public function setPart($part)
    {

    }
}

class Gargge
{

    private $capaciti = 6;

    private $vehicles = [];

    public function addVehicle(Vehicle $vehicle)
    {
        $vehicle->drive();
        if ($vehicle->getDimension() <= $this->capaciti){
            $this->capaciti -= $vehicle->getDimension();
            $this->vehicles[] = $vehicle;
        }else{
            throw new Exception('Vehicle too big'."\n"."</br>");
        }



    }



}

$garagge = new Gargge();

try {
    $garagge->addVehicle(new Car);
    $garagge->addVehicle(new Motorsycle);
}catch (Exception $e) {
    echo $e->getMessage() . "\n" . "</br>";

}
    echo '<pre>';
    var_dump($garagge);
    echo '</pre>';
function changePart(Mashine $mashine){

    $mashine->getParts();

}


