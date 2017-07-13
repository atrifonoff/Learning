<?php

/**
 * Created by PhpStorm.
 * User: angel
 * Date: 12.07.17
 * Time: 09:01
 */
class Box
{

    /**
     * @var float
     */
    private $lenght;

    /**
     * @var float
     */
    private $width;

    /**
     * @var float
     */
    private $height;


    /**
     * Box constructor.
     */
    public function __construct($lenght, $width, $height)
    {
        $this->setLenght($lenght);
        $this->setHeight($height);
        $this->setWidth($width);


    }

    /**
     * @param float $lenght
     */
    private function setLenght($lenght)
    {
        if ($lenght<=0) {
            throw new Exception('The lenght can not be negative');

        }
        $this->lenght = $lenght;
    }

    /**
     * @param float $width
     */
    private function setWidth($width)
    {
        if ($width<=0){
            throw new Exception('The width can not be negative');
        }
        $this->width = $width;
    }

    /**
     * @param float $height
     */
    private function setHeight($height)
    {
        if ($height<=0){throw new Exception('The height can not be negative');
        }
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getVolume()
    {

        return $this->lenght*$this->height*$this->width;
    }

    /**
     * @return float
     */
    public function getLateralSurficeArea()

    {

        return (2*($this->lenght*$this->height))
        +(2*($this->width*$this->height));
    }

    /**
     * @return float
     */
    public function getSurficeArea()
    {
        return (2*($this->lenght*$this->height))
        +(2*($this->lenght*$this->width))
        +(2*($this->height*$this->width));
    }


}
try {

    $lenght = floatval(trim(fgets(STDIN)));
    $width = floatval(trim(fgets(STDIN)));
    $height = floatval(trim(fgets(STDIN)));
    $box = new Box($lenght, $height, $width);

    echo 'Surfice Area = ' . number_format($box->getSurficeArea(), 2) . "\n";
    echo 'Lateral Surface Area = ' . number_format($box->getLateralSurficeArea(), 2) . "\n";
    echo 'Volume = ' . number_format($box->getVolume(), 2) . "\n";
}catch (Exception $e){
    echo $e->getMessage();
}