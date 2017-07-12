<?php


namespace Core\Commands;


/**
 * Class AttackCommand
 * @package Core\Commands
 */
class AttackCommand extends CommandAbstract
{

    /**
     * @param array $args
     * @return string
     * @throws \Exception
     */
    public function execute(array $args = [])
    {
        array_shift($args);
        $attackerName = array_shift($args);
        $defenderName = array_shift($args);

        $attacker = $this->galaxy->getShip($attackerName);
        $defender = $this->galaxy->getShip($defenderName);

        if (!$attacker->isAlive() || !$defender->isAlive()) {
            throw new \Exception("Ship is destroyed 1");
        }

        if ($attacker->getStarSystem() != $defender->getStarSystem()) {
            throw new \Exception("No such ship in star system");
        }

        $attacker->attack($defender);

        $output = "$attackerName attacked $defenderName";

        if (!$defender->isAlive()) {
            $output .= PHP_EOL . "$defenderName has been destroyed !";
        }

        return $output;
    }
}