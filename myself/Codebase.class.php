<?php

class myself_Codebase extends core_Manager

{
    public $title = "Анализ";
    public $loadList = 'plg_Created,plg_Modified';
    public $listFields = 'id,path,lines,phpClasses,modifiedOn=Модифициране';
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



//    function act_FileProcessing()
//    {
//
//        return 'File processing';
//
//    }



    /**
     * @return string
     */
    function act_ReadFiles()
    {

        /**
         * Установява необходима роля за да се стартира екшъна
         */
        requireRole('admin');

        //В $root запомняме директорията от която трябва да стартира екшъна.
        //В случая __DIR__ намира директорията на текущия файл и след това
        // DIRECTORY_SEPARATOR.'..' връща една dir назад//

        /**
         * Директория за стартиране
         */
        $root = realpath(__DIR__ . DIRECTORY_SEPARATOR. '..' );


        $files = array();
        $methods = array();
        $usesMetods = array();
        $onMethods = array();
        $couldntLoadsClasses = array();
        $onMethods_string = 0;
        $totalLines = 0;
        $totalLoadClasses = 0;
        $filesCounter = 0;
        $emptyLineCounter = 0;
        $totalMethods = 0;

//$this->act_FileProcessing();



        self::readFiles($root, $files);

        foreach($files as $f) {

            $filesCounter++;

            if(self::loadClasses($root, $f, $methods,$couldntLoadsClasses, $onMethods)) {

                $onMethods_string = implode($onMethods,"<br>");

                $totalLoadClasses++;

                $usesMetods = array_merge($usesMetods, $methods);

                $totalMethods += count($methods);
            }

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
            $emptyLineCounter+=self::emptyLineCounter($f);

            self::save($rec);

//            if($filesCounter >= 190) bp('Общ брой файлове :'.$filesCounter,'Брой редове :'.$totalLines,'Брой празни редове :'.$emptyLineCounter,
//                'Брой заредени класове :'.$totalLoadClasses,'Не успях да заредя следните PHP-класове :'.$couldntLoadsClasses,
//                'Брой методи :'.$totalMethods,'on_Methods :'.count($onMethods), array_values($onMethods));

        }
//        bp('Общ брой файлове :'.$filesCounter,'Брой редове :'.$totalLines,'Брой празни редове :'.$emptyLineCounter,
//            'Брой заредени класове :'.$totalLoadClasses,'Не успях да заредя следните PHP-класове :'.$couldntLoadsClasses,
//            'Брой методи :'.$totalMethods,'on_Methods :'.count($onMethods), array_values($onMethods));

//bp(count($onMethods),arsort($onMethods),$onMethods);
        return 'Общо файлове :'.$filesCounter.'<br>'.'Брой линии : '.$totalLines."<br>".'Брой празни редове :'.$emptyLineCounter
        .'<br>'.' Брой заредени класове  : '.$totalLoadClasses."<br>".'Не успях да заредя следните PHP-класове :'.$couldntLoadsClasses
        ."<br>".'Брой методи : '.$totalMethods."<br>".'on_Methods :'.count($onMethods).'<br>'.'<br>'.$onMethods_string;

    }




    /**
     * @param $root
     * @param array $files
     */
    static function readFiles($root, &$files = array())

    {
        if ($handle = opendir($root)) {

            while (FALSE !== ($entry = readdir($handle))) {

                if ($entry == "." || $entry == ".." || $entry == "unit") continue;

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
    /**
     * @param $root
     * @param $f
     * @param array $methods
     * @return bool
     */

    static function loadClasses($root, $f, &$methods=array(),&$couldntLoadsClasses=array(),&$onMethods=array())
    {
        //    return array('isLoaded' => TRUE, 'methods' => array(...));

        $ext = fileman_Files::getExt($f);

        $classLoadResult = FALSE;

        if(($ext === 'php') && (bool)strpos($f,'.class.php')) {

            $className = str_replace($root, '', $f);

            $className = str_replace(DIRECTORY_SEPARATOR, '_', trim($className, DIRECTORY_SEPARATOR));

            $className = str_replace(".class.php", '', $className);

            if (@cls::load($className,TRUE)) {
                ;
                $classLoadResult = TRUE;

                $class = new ReflectionClass($className);

                $methods = $class->getMethods();

                foreach ($methods as $id => $m) {

                    if (strtolower(trim($m->class)) != strtolower(trim($className))) {

                        unset($methods[$id]);

                    }else{ if(substr($m->name,0,3) == 'on_'){

                        $onMethods[substr($m->name,3)] = $m->name;
                        //  $onMethods[$m->name]++;

                    }
                    }
                }

            } else {
                $couldntLoadsClasses[] = $className;
            }
        }
        return $classLoadResult;
    }

    /**
     * @param string $f
     * @return int
     */
    static function emptyLineCounter ($f)
    {
        $emptyLines = 0;

        $handle = fopen("$f", "r");

        if ($handle) {

            while (($line = fgets($handle)) !== false) {

                if((trim($line) == NULL)){

                    $emptyLines++;
                }
            }
            fclose($handle);
        } else {
            return 'Error opening file';
        }
        return $emptyLines;
    }
}