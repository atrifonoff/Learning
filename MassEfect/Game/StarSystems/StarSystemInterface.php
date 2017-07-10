<?php
/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 07.07.17
 * Time: 18:08
 */

namespace Game\StarSystems;


interface StarSystemInterface
{

    public function addNeighbour($solarSystemName, $fuelNeeded);

    public function getName();

}
