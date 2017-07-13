<?php


namespace Core\Commands;


/**
 * Class StatusReportCommand
 * @package Core\Commands
 */
class StatusReportCommand extends CommandAbstract
{

    /**
     * @param array $args
     * @return string
     */
    public function execute(array $args = []): string
    {
        array_shift($args);
        $shipName = array_shift($args);
        $ship = $this->galaxy->getShip($shipName);

        return $ship . "";
    }
}