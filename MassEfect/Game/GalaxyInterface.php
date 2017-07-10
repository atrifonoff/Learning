<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 09.07.17
 * Time: 10:42
 */

namespace Game;
use Game\StarSystems\StarSystemInterface;

interface GalaxyInterface
{
    public function getStarSystem($name);

    public function addStarSystem($name,StarSystemInterface $starSystem);


}