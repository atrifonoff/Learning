<?php


namespace Core\Commands;


/**
 * Interface Executable
 * @package Core\Commands
 */
interface Executable
{
    /**
     * @param array $args
     * @return mixed
     */
    public function execute(array $args = []);
}