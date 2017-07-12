<?php
namespace Game;

use Entites\Ships\ShipInterface;
use Game\StarSystems\StarSystemInterface;

/**
 * Class Galaxy
 * @package Game
 */
class Galaxy implements GalaxyInterface
{
    /**
     * @var StarSystemInterface[]
     */
    private $starSystems = [];

    /**
     * @var ShipInterface[]
     */
    private $ships = [];

    /**
     * @param $name
     * @return StarSystemInterface
     */
    public function getStarSystem($name)
    {
        return $this->starSystems[$name];
    }

    /**
     * @param $name
     * @param StarSystemInterface $starSystem
     */
    public function addStarSystem($name, StarSystemInterface $starSystem)
    {
        $this->starSystems[$name] = $starSystem;
    }

    /**
     * @param $name
     * @return bool
     */
    public function shipExists($name)
    {
        return array_key_exists($name, $this->ships);
    }

    /**
     * @param ShipInterface $ship
     */
    public function addShip(ShipInterface $ship)
    {
        $this->ships[$ship->getName()] = $ship;
    }

    /**
     * @param $name
     * @return ShipInterface
     */
    public function getShip($name): ShipInterface
    {
        return $this->ships[$name];
    }
}