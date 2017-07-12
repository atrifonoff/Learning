<?php


namespace Core\Commands;


/**
 * Class PlotJumpCommand
 * @package Core\Commands
 */
class PlotJumpCommand extends CommandAbstract
{

    /**
     * @param array $args
     * @return string
     * @throws \Exception
     */
    public function execute(array $args = [])
    {
        array_shift($args);
        $shipName = array_shift($args);
        $starSystemName = array_shift($args);

        $starSystem = $this->galaxy->getStarSystem($starSystemName);
        $ship = $this->galaxy->getShip($shipName);

        if (!$ship->isAlive()) {
            throw new \Exception('Ship is destroyed');
        }

        if ($ship->getStarSystem() == $starSystem) {
            throw new \Exception("Ship is already in $starSystemName");
        }

        $oldSystem = $ship->getStarSystem();

        $oldSystem->travelTo($shipName, $starSystem);

        return "$shipName jumped from {$oldSystem->getName()} to $starSystemName";
    }
}