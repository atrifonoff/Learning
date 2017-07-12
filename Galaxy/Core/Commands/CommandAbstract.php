<?php


namespace Core\Commands;


use Game\GalaxyInterface;

/**
 * Class CommandAbstract
 * @package Core\Commands
 */
abstract class CommandAbstract implements Executable
{
    /**
     * @var GalaxyInterface
     */
    protected $galaxy;

    /**
     * CommandAbstract constructor.
     * @param GalaxyInterface $galaxy
     */
    public function __construct(GalaxyInterface $galaxy)
    {
        $this->galaxy = $galaxy;
    }


}