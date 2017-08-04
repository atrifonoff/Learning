<?php


namespace MassEffectGame\Models;


use MassEffectGame\Models\Ships\ShipInterface;

interface GalaxyInterface
{
    /**
     * @param ShipInterface $ship
     * @return void
     */
    public function addShip(ShipInterface $ship);

    /**
     * @param string $name
     * @return bool
     */
    public function shipExists( $name);

    /**
     * @param string $name
     * @return ShipInterface
     */
    public function getShipByName( $name);

    /**
     * @param string $name
     * @return StarSystemInterface
     */
    public function getStarSystemByName( $name);
}