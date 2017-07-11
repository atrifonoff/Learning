<?php

/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 11.07.17
 * Time: 16:11
 */
class opit_Homes extends core_Manager
{


    public $title = "Къщи";

    public $loadList = 'plg_RowTools2,plg_Sorting';

    function description()
    {
        $this->FLD('type', 'enum(villa,flat,block of flats)', 'caption=Тип');
        $this->FLD('area', 'int', 'caption=Площ,mandatory');
        $this->FLD('address', 'text', 'caption=Адрес');
        $this->FLD('buildOn', 'date', 'caption=Построяване');

    }



}