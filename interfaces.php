<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 05.07.17
 * Time: 16:01
 */

class Offece{

    public function writeDocument($document, Writer $writer)
        {
            $writer->write($document);
        }

}

class Closet
{

    public function gangePart(Mashine $mashine, $part)
    {
        if ($mashine->getPart($part)){
            $mashine->setPart($part);
        }



    }
}

        interface Writer
        {
            public function write($text);
        }


        interface Mashine
        {
            public function getParts();

            public function getPart($part);

            public function setPart($part);

        }





class Pen implements Writer
{
    private $inc;

    public function __construct($inc)
    {
        $this->inc=$inc;
    }

    public function write($text)
    {
        for ($i=0; $i<strlen($text); $i++)
        {
            echo $text[$i];

            $this->inc--;

            if ($this->inc==0){
                echo "</br>";
                return;
            }

        }
        echo "</br>";
    }

}

class TypeWriter implements Writer, Mashine
{

    private $paper;
    private $parts = ['head','keyboard'];

    /**
     * TypeWriter constructor.
     * @param $paper
     */
    public function __construct($paper)
    {
        $this->paper = $paper;
    }

    public function write($text){
        for ($i=0; $i<strlen($text); $i++){
            echo $text[$i];
            if ($text[$i]==' ') {
                $this->paper--;
                if ($this->paper == 0) {
                    echo "</br>";
                    return;
                }
            }

        }
        echo "</br>";

    }

    public function getParts()
    {
        return $this->parts;
    }

    public function getPart($part)
    {
        return in_array($part, $this->getParts());
    }

    public function setPart($part)
    {
        foreach ($this->parts as $key =>$partFromArray)
        {
            if ($partFromArray==$part){
                echo "We cganged typwriter's $part </br>";
            }
        }
    }


}

class Printer implements Writer, Mashine
{
    private $parts = ['laser'];

    public function write($text)
    {
        echo $text."</br";
    }

    public function getParts()
    {
        return $this->parts;
    }

    public function getPart($part)
    {
        return in_array($part, $this->getParts());
    }

    public function setPart($part)
    {
        foreach ($this->parts as $key =>$partFromArray)
        {
            if ($partFromArray==$part){
                echo "We cganged printer's $part </br>";
            }
        }
    }



}

$office = new Offece();
$office->writeDocument('Towa e dcumenta na Pesho',new TypeWriter(14));

$closet=new Closet();
$closet->gangePart(new TypeWriter(1),'head');