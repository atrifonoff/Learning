<?php


namespace MassEffectGame\Models;


use MassEffectGame\Models\Ships\ShipInterface;

class StarSystem implements StarSystemInterface
{
    private $name;

    /**
     * @var string[]
     */
    private $neighbours;

    /**
     * @var ShipInterface[]
     */
    private $ships = [];

    /**
     * StarSystem constructor.
     * @param $name
     * @param string[] $neighbours
     */
    public function __construct($name, array $neighbours)
    {
        $this->name = $name;
        $this->neighbours = $neighbours;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param ShipInterface $ship
     * @return void
     */
    public function addShip(ShipInterface $ship)
    {
        $this->ships[$ship->getName()] = $ship;
        $ship->setStarSystem($this);
    }

    /**
     * @param string $shipName
     * @return void
     */
    public function removeShip( $shipName)
    {
        unset($this->ships[$shipName]);
    }

    /**
     * @return string[]
     */
    public function getNeighbours()
    {
        return $this->neighbours;
    }

    /**
     * @return ShipInterface[]
     */
    public function getShips()
    {
        return array_values($this->ships);
    }
}