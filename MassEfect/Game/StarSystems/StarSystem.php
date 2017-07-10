<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 09.07.17
 * Time: 10:55
 */

namespace Game\StarSystems;


class StarSystem implements StarSystemInterface
{
    private $neighbours = [];

    private $name;

    /**
     * StarSystem constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    public function addNeighbour($solarSystemName, $fuelNeeded)
{
    $this->neighbours[$solarSystemName] = $fuelNeeded;

}
public function getName()
{
    return $this->name;
}


}