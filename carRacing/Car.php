<?php

/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 30.06.17
 * Time: 17:21
 */

/**
 * Car Racing
 * Конзолно приложение , което създава клас кола с дефинирани : МОДЕЛ, КОЛИЧЕСТВО ГОРИВО И РАЗХОД НА ГОРИВО ЗА КИЛОМЕТЪР.
 * след това създава масив от обекти коли n на брой и приема команди от конзолата
 * Командите са за придвижване  с на определени километри. При това предвижване
 * колата изразходва гориво. При постъпване на команда End приложението разпечатва списък на колите в масива в текущото
 * състояние.
 */
class Car
{
    public $model;
    public $fuelAmount;
    public $fuelCost;
    public $distanceTavelled;

    /**
     * Car constructor.
     * @param string $model
     * @param float $fuelAmound
     * @param float $fuelCost
     */

    public  function __construct($model,
                                 $fuelAmound,
                                 $fuelCost)
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
    public  function drive($km)
    {
        $cost = $km * $this ->fuelCost;
        if ($cost > $this ->fuelAmount){
            throw new Exception('Insufficient fuel for the drive');
        }
        $this ->fuelAmount -= $cost;
        $this ->distanceTavelled += $km;
    }

    public function __toString()   // Функцията стрингосва съдържанието на обекта и го разпечатва в посочения формат//
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

echo 'Input: < command > < model car > < km > '."\n";

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