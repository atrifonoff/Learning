<?php

/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 07.07.17
 * Time: 17:52
 */

namespace Game;
use Game\StarSystems\StarSystemInterface;


class Galaxy implements GalaxyInterface
{
    /**
     * @var array StarSystemIterface[]
     */
    private $starSystems = [];

    /**
     * @param $name
     */
    public function getStarSystem($name)

    {
        return $this->starSystems[$name];
    }


    public function addStarSystem($name,StarSystemInterface $starSystem)

    {
        $this->starSystems[$name]=$starSystem;
    }

}