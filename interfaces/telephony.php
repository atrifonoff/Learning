<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 12.07.17
 * Time: 10:59
 */

interface ICall
{
    /**
     * @param array $phone_numbers
     * @return mixed
     */
    public function call(array $phone_numbers);

}


/**
 * Interface IBrouse
 */
interface IBrowse
{

   public function browse(array $sites);


}

abstract class Smartphpne implements ICall, IBrowse
{

    private $phone_numbers;

    private $sites;

    /**
     * Smartphpne constructor.
     * @param $phone_numbers
     */
    public function __construct(array $phone_numbers, array $sites)
    {
        $this->setPhoneNumbers(array($phone_numbers));
        $this->setSites(array($sites));


    }

    /**
     * @param mixed $phone_numbers
     */
    public function setPhoneNumbers($phone_numbers)
    {
        $this->phone_numbers = $phone_numbers;
    }

    /**
     * @param mixed $sites
     */
    public function setSites($sites)
    {


        $this->sites = $sites;
    }




}