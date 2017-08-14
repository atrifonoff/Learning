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
        $this->FLD('phpClasses','int','caption=PHP класове');
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
        $methods = array();
        $totalLines = 0;
        $totalLoadClasses = 0;
        $filesCounter = 0;
        $emptyLineCounter = 0;
        $totalMethods = 0;

        self::readFiles($root, $files);

        foreach($files as $f) {

            $filesCounter++;

            if(self::loadClasses($root,$f,$methods)) {

                $totalLoadClasses++;

                $totalMethods = (count($methods,COUNT_RECURSIVE) - count($methods,COUNT_NORMAL));

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

            if($filesCounter >= 70)bp('Брой заредени класове :'.$totalLoadClasses,'Общ брой файлове :'
                .$filesCounter,'Брой редове :'.$totalLines,'Брой празни редове :'.$emptyLineCounter,
                'Брой методи :'.$totalMethods);
        }
        return 'Брой линии : '.$totalLines."<br>".'Брой празни редове :'.$emptyLineCounter
        .'<br>'.'Общо файлове :'.$filesCounter.'<br>'.' Брой заредени класове  : '.$totalLoadClasses
        ."<br>".'Брой методи : '.$totalMethods;
    }
    /**
     * @param $root
     * @param array $files
     */
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

    /**
     * @param $root
     * @param $f
     * @param array $methods
     * @return bool
     */
    static function loadClasses ($root,$f, &$methods=array())
    {
        $ext = fileman_Files::getExt($f);
        $classLoadResult = FALSE;
        if(($ext === 'php') && (bool)strpos($f,'.class.php')) {
            $className = str_replace($root, '', $f);
            $className = str_replace(DIRECTORY_SEPARATOR, '_', trim($className, DIRECTORY_SEPARATOR));
            $className = str_replace(".class.php", '', $className);

            $class = new ReflectionClass($className);
            $methods[] = $class->getMethods();

            try {
                @cls::load($className,TRUE);
                $classLoadResult = TRUE;
            } catch (Error $e) {
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