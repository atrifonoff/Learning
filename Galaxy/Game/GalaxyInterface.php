<?php


namespace Game;


use Entites\Ships\ShipInterface;
use Game\StarSystems\StarSystemInterface;

/**
 * Interface GalaxyInterface
 * @package Game
 */
interface GalaxyInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function getStarSystem($name);

    /**
     * @param $name
     * @param StarSystemInterface $starSystem
     * @return mixed
     */
    public function addStarSystem($name, StarSystemInterface $starSystem);

    /**
     * @param $name
     * @return mixed
     */
    public function shipExists($name);

    /**
     * @param ShipInterface $ship
     * @return mixed
     */
    public function addShip(ShipInterface $ship);

    /**
     * @param $name
     * @return mixed
     */
    public function getShip($name);

}