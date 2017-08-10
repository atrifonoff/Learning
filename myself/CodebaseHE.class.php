<?php

/**
 * Created by PhpStorm.
 * User: krisko
 * Date: 30.06.17
 * Time: 18:24
 */
class myself_Codebase extends core_Manager
{


    public $title = "Анализ";

    public $loadList = 'plg_Created,plg_Modified';

    public $listFields = 'id,path,lines,modifiedOn=Модифициране';

    protected function description()
    {
        $this->FLD('path', 'varchar','caption=Път');
        $this->FLD('code', 'text(1000000)', 'caption=Код,column=none');
        $this->FLD('lines', 'int', 'caption=Брой линии');

        $this->setDbUnique('path');

    }

    /**
     * Преди показване на листовия тулбар
     *
     * @param core_Manager $mvc
     * @param stdClass $data
     */
    public static function on_AfterPrepareListToolbar($mvc, &$res, $data)
    {
        $data->toolbar->addBtn('Анализ', array($mvc, 'ReadFiles'));
    }



    /**
     * @return string
     */

    function act_ReadFiles()
    {
        //Установява необходима роля за да се стартира екшъна //
        requireRole('admin');

        //В $root запомняме директорията от която трябва да стартира екшъна.
        //В случая __DIR__ намира директорията на текущия файл и след това
        // DIRECTORY_SEPARATOR.'..' връща една dir назад//
        $root = realpath(__DIR__ . DIRECTORY_SEPARATOR. '..' );

        $files = array();
        $emptyLines = array();

        self::readFiles($root, $files);

        $totalLines = 0;
        $emptyLineCounter = 0;
        $numericFiles = array();

        foreach($files as $f) {
            $numericFiles[] = $f;
            $emptyLineCounter = 0;
            $handle = fopen("$f", "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {

                    if((trim($line) == NULL)){
                        $emptyLineCounter ++;

                    }

                }

                fclose($handle);

            } else {
                return 'Error opening file';
            }

            if(array_key_exists(2345,$numericFiles)) bp($emptyLineCounter,$f);



            $exRec = self::fetch("#path = '{$f}'");

            $rec = new stdClass();
            if(isset($exRec)) {
                $rec->id = $exRec->id;
            }

            $rec->path = $f;

            $ext = fileman_Files::getExt($f);

            if(in_array($ext, array('php', 'js', 'shtml', 'scss'))) {
                $rec->code = file_get_contents($f);
                $rec->lines = substr_count($rec->code, "\n");
                $totalLines += $rec->lines;
            }
            // bp(strlen($f),$files);
            self::save($rec);
        }

        return 'Общо линии: '. $totalLines;
    }

    static function readFiles($root, &$files = array())
    {
        if ($handle = opendir($root)) {

            while (FALSE !== ($entry = readdir($handle))) {

                if ($entry == "." || $entry == "..") continue;


                $entry = $root . DIRECTORY_SEPARATOR . $entry;

                if(is_dir($entry)) {
                    self::readFiles($entry, $files);
                    continue;
                }

                $files[$entry] = $entry;

            }

            closedir($handle);
        }
    }


}
