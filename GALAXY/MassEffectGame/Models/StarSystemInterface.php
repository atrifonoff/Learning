<?php


namespace MassEffectGame\Models;


use MassEffectGame\Models\Ships\ShipInterface;

interface StarSystemInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function getNeighbours();

    /**
     * @return array
     */
    public function getShips();

    /**
     * @param ShipInterface $ship
     * @return mixed
     */
    public function addShip(ShipInterface $ship);

    /**
     * @param string $shipName
     * @return mixed
     */
    public function removeShip($shipName);
}