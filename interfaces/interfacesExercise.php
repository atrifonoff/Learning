<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 12.07.17
 * Time: 07:45
 */

interface IPerson
{

    /**
     * @return mixed
     */
    public function getName();


}

/**
 * Class Citizen
 */
class Citizen implements IPerson
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $age;


    /**
     * Citizen constructor.
     * @param string $name
     * @param int $age
     */
    function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;


    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }


}

$citizen = new Citizen('Pesho',25);
echo $citizen->getName();