<?php

/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 30.06.17
 * Time: 17:21
 */
class Car
{
    public $model;
    public $fuelAmount;
    public $fuelCost;
    public $distanceTavelled;


    public  function __construct(string $model,
                                 float $fuelAmound,
                                 float $fuelCost)
    {
        $this ->model = $model;
        $this ->fuelAmount = $fuelAmound;
        $this ->fuelCost = $fuelCost;
        $this ->distanceTavelled = 0;

    }

    /**
     * @param float $km
     * @throws Exception
     */
    public  function drive(float $km)
    {
        $cost = $km * $this ->fuelCost;
        if ($cost > $this ->fuelAmount){
            throw new Exception('Insufficient fuel for the drive');
        }
        $this ->fuelAmount -= $cost;
        $this ->distanceTavelled += $km;
    }

    public function __toString()
    {
        return $this ->model.' # '.
        number_format($this ->fuelAmount,2).' # '.
        $this ->distanceTavelled;
    }

}


//$car = new Car('AudiA4', 23.654656, 0.3);
//echo $car;

$cars = [];

$n = intval(fgets(STDIN));

while ($n--)
{
    $line = trim(fgets(STDIN));
    $tokens = explode(' ',$line);
    $model = $tokens[0];
    $startFuel = floatval($tokens[1]);
    $fuelCost = floatval($tokens[2]);

    $car = new Car($model, $startFuel, $fuelCost);
    $cars[$model] = $car;

}



$cmd = trim(fgets(STDIN));


 while ($cmd != 'End')
 {
     $tokens = explode(' ',$cmd);
     $model = $tokens[1];
     $km = floatval($tokens[2]);
     $car = $cars[$model];
     try {
         $car->drive($km);
     }catch (Exception $e){
         echo $e->getMessage().PHP_EOL;
     }


     $cmd = trim(fgets(STDIN));
 }
foreach ($cars as $car)
{
    echo $car.PHP_EOL;
}