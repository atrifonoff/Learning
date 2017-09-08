<?php



/**
 * Мениджър на отчети по документи в зависимост от ролите
 *
 * @category  bgerp
 * @package   doc
 * @author    Angel Trifonov angel.trifonoff@gmail.com
 * @copyright 2006 - 2017 Experta OOD
 * @license   GPL 3
 * @since     v 0.1
 * @title     Документи » Създадени документи по роля
 */
class doc_reports_DocsByRols extends frame2_driver_TableData
{


    /**
     * Кой може да избира драйвъра
     */
    public $canSelectDriver = 'manager,ceo';

    /**
     * Добавя полетата на драйвера към Fieldset
     *
     * @param core_Fieldset $fieldset
     */
    public function addFields(core_Fieldset &$fieldset)
    {

        $fieldset->FLD('roleId', 'key(mvc=core_Roles,select=role,allowEmpty)', 'caption=Роля,after=title,mandatory');
        $fieldset->FLD('from', 'datetime', 'caption=Период->От,mandatory,after=role');
        $fieldset->FLD('to', 'datetime', 'caption=Период->До,mandatory');
        $fieldset->FLD('documents', 'keylist(mvc=core_Classes,select=name)', 'caption=Документи,after=to');
    }

    /**
     * Кои записи ще се показват в таблицата
     *
     * @param stdClass $rec
     * @param stdClass $data
     * @return array
     */
    protected function prepareRecs($rec, &$data = NULL)
    {


        $recs = array();

        $query = doc_Containers::getQuery();



        $query->where(array("#createdOn >= '[#1#]' AND #createdOn <= '[#2#]'", $rec->from, $rec->to ));

        $query->where("#state != 'rejected'");



        if(isset( $rec->documents)){

            $documentsForCheck = type_Keylist::toArray($rec->documents);

            $query->whereArr("docClass", $documentsForCheck, TRUE);

        }

        $query->in('createdBy', core_Users::getByRole($rec->roleId));

        //  bp(core_Users::getByRole($rec->roleId));
        // $documentsEkstracted  = $query->fetchAll();

        $recs = array();
//bp($query->where, $query->count());
        foreach ($query->fetchAll() as $doc){

//            $recs[($doc->docClass)][] = $doc;
            $recs[$doc->docClass]['users'] =  type_Keylist::addKey($recs[$doc->docClass]['users'], $doc->createdBy);
            $recs[$doc->docClass]['cnt']++;
            $recs[$doc->docClass]['docClass'] = $doc->docClass;

        }
//bp($recs);

//        while($rec = $query->fetch()){
//
//
//           $recs[($query->fetch()->docClass)]++;
//
//
//        };



        // bp($recs);
        //bp(count($documentsEkstracted),$documentsEkstracted[119],$documentsEkstracted[119]->docClass);

        //  bp(count($recs),self::getClassId(),$linkFordoc);

        return $recs;
    }



    /**
     * Връща фийлдсета на таблицата, която ще се рендира
     *
     * @param stdClass $rec      - записа
     * @param boolean $export    - таблицата за експорт ли е
     * @return core_FieldSet     - полетата
     */
    protected function getTableFieldSet($rec, $export = FALSE)
    {
        $fld = cls::get('core_FieldSet');

        if($export === FALSE){
            //  $fld->FLD('num', 'varchar','caption=№');
            $fld->FLD('person', 'varchar', 'caption=Служител');
            $fld->FLD('indicator', 'varchar', 'caption=Тип документ');
            $fld->FLD('value', 'double(smartRound,decimals=2)', 'smartCenter,caption=Брой');

        } else {
            //    $fld->FLD('num', 'varchar','caption=№');
            $fld->FLD('person', 'varchar', 'caption=Служител');
            $fld->FLD('indicator', 'varchar', 'caption=Тип документ');
            $fld->FLD('value', 'double(smartRound,decimals=2)', 'smartCenter,caption=Брой');
        }

        return $fld;
    }


    /**
     * Вербализиране на редовете, които ще се показват на текущата страница в отчета
     *
     * @param stdClass $rec  - записа
     * @param stdClass $dRec - чистия запис
     * @return stdClass $row - вербалния запис
     */
    protected function detailRecToVerbal($rec, &$dRec)
    {
//bp($dRec);
        $Int = cls::get('type_Int');

        $row = new stdClass();

        $row->person = core_Users::getNick(1);

        $row->value = $Int->toVerbal($dRec['cnt']);

        $row->indicator = cls::get($dRec['docClass'])->className;

        return $row;



        $isPlain = Mode::is('text', 'plain');

        $Date = cls::get('type_Date');
        $Double = cls::get('type_Double');
        $Double->params['decimals'] = 2;
        $row = new stdClass();
        $Varchar = cls::get('type_Varchar');

        // Линк към служителя
        if(isset($dRec->person)) {
            $userId = crm_Profiles::fetchField("#personId = '{$dRec->person}'",'userId');
            $nick = crm_Profiles::createLink($userId)->getContent();
            //crm_Profiles::fetchField("#personId = '{$rec->alternatePerson}'", 'userId');
            $row->person = crm_Persons::fetchField($dRec->person, 'name') . " (" . $nick .")";
        }

        if($isPlain){
            $row->person = strip_tags(($row->person instanceof core_ET) ? $row->person->getContent() : $row->person);
        }

        if(isset($dRec->num)) {
            $row->num = $Int->toVerbal($dRec->num);
        }

        if(isset($dRec->indicatorId)) {
            $row->indicator = hr_IndicatorNames::fetchField($dRec->indicatorId,'name');
        }

        if(isset($dRec->value)) {
            $row->value = $Double->toVerbal($dRec->value);
        }

//bp($dRec, $rec);
        $row->person = core_Users::getNick($rec->createdBy);
        $row->indicator = 'something';
        $row->value= '2123456789';

        return $row;
    }



    //    /**
//     * Полета от таблицата за скриване, ако са празни
//     *
//     * @var int
//     */
//    //protected $filterEmptyListFields = 'deliveryTime';
//
//
//    /**
//     * По-кое поле да се групират листовите данни
//     */
//    protected $groupByField = 'person';
//
//
//    /**
//     * Полета за хеширане на таговете
//     *
//     * @see uiext_Labels
//     * @var varchar
//     */
//    protected $hashField = '$recIndic';
//
//
//    /**
//     * Кое поле от $data->recs да се следи, ако има нов във новата версия
//     *
//     * @var varchar
//     */
//    protected $newFieldToCheck = 'docId';
//
//
//    /**
//     * Добавя полетата на драйвера към Fieldset
//     *
//     * @param core_Fieldset $fieldset
//     */
//    public function addFields(core_Fieldset &$fieldset)
//    {
//        $fieldset->FLD('personId', 'type_UserList', 'caption=Потребител,after=title,single=none');
//        $fieldset->FLD('periods', 'key(mvc=acc_Periods,select=title)', 'caption=Месец,after=title,single=none');
//    }
//
//
//    /**
//     * Преди показване на форма за добавяне/промяна.
//     *
//     * @param frame2_driver_Proto $Driver $Driver
//     * @param embed_Manager $Embedder
//     * @param stdClass $data
//     */
//    protected static function on_AfterPrepareEditForm(frame2_driver_Proto $Driver, embed_Manager $Embedder, &$data)
//    {
//        $form = &$data->form;
//
//        $periodToday = acc_Periods::fetchByDate(dt::now());
//        $form->setDefault('periods', $periodToday->id);
//    }
//
//
//    /**
//     * Кои записи ще се показват в таблицата
//     *
//     * @param stdClass $rec
//     * @param stdClass $data
//     * @return array
//     */
//    protected function prepareRecs($rec, &$data = NULL)
//    {
//        $recs = array();
//        $persons = array();
//        $personsId = array();
//        $date = acc_Periods::fetch($rec->periods);
//
//        $query = hr_Indicators::getQuery();
//
//        // кои потребители търсим
//        $persons = keylist::toArray($rec->personId);
//
//        // ограничаваме по дата
//        $query->where("(#date >= '{$date->start}' AND #date <= '{$date->end}')");
//
//        if(count($persons)){
//            foreach ($persons as $person) {
//                // търсим ид-то на профила му
//                $personId = crm_Profiles::fetchField("#userId = '{$person}'",'personId');
//
//                array_push($personsId,$personId);
//            }
//            $personsId = implode(',', $personsId);
//
//            $query->where("#personId IN ({$personsId})");
//        }
//
//        // за всеки един индикатор
//        while($recIndic = $query->fetch()){
//            $id = $recIndic->personId."|".$recIndic->indicatorId;
//            // добавяме в масива събитието
//            if(!array_key_exists($id,$recs)) {
//                $recs[$id]=
//                    (object) array (
//                        'num' => 0,
//                        'date' => $recIndic->date,
//                        'docId' => $recIndic->docId,
//                        'person' => $recIndic->personId,
//                        'indicatorId' => $recIndic->indicatorId,
//                        'value' => $recIndic->value,
//                    );
//
//            } else {
//                $obj = &$recs[$id];
//                $obj->value += $recIndic->value;
//            }
//        }
//
//        $num = 1;
//        foreach($recs as $r) {
//            $r->num = $num;
//            $num++;
//        }
//
//        return $recs;
//    }
//
//
//    /**
//     * Връща фийлдсета на таблицата, която ще се рендира
//     *
//     * @param stdClass $rec      - записа
//     * @param boolean $export    - таблицата за експорт ли е
//     * @return core_FieldSet     - полетата
//     */
//    protected function getTableFieldSet($rec, $export = FALSE)
//    {
//        $fld = cls::get('core_FieldSet');
//
//        if($export === FALSE){
//            $fld->FLD('num', 'varchar','caption=№');
//            $fld->FLD('person', 'varchar', 'caption=Служител');
//            $fld->FLD('indicator', 'varchar', 'caption=Показател');
//            $fld->FLD('value', 'double(smartRound,decimals=2)', 'smartCenter,caption=Стойност');
//
//        } else {
//            $fld->FLD('num', 'varchar','caption=№');
//            $fld->FLD('person', 'varchar', 'caption=Служител');
//            $fld->FLD('indicator', 'varchar', 'caption=Показател');
//            $fld->FLD('value', 'double(smartRound,decimals=2)', 'smartCenter,caption=Стойност');
//        }
//
//        return $fld;
//    }
//
//
//    /**
//     * Вербализиране на редовете, които ще се показват на текущата страница в отчета
//     *
//     * @param stdClass $rec  - записа
//     * @param stdClass $dRec - чистия запис
//     * @return stdClass $row - вербалния запис
//     */
//    protected function detailRecToVerbal($rec, &$dRec)
//    {
//        $isPlain = Mode::is('text', 'plain');
//        $Int = cls::get('type_Int');
//        $Date = cls::get('type_Date');
//        $Double = cls::get('type_Double');
//        $Double->params['decimals'] = 2;
//        $row = new stdClass();
//
//
//        // Линк към служителя
//        if(isset($dRec->person)) {
//            $userId = crm_Profiles::fetchField("#personId = '{$dRec->person}'",'userId');
//            $nick = crm_Profiles::createLink($userId)->getContent();
//            //crm_Profiles::fetchField("#personId = '{$rec->alternatePerson}'", 'userId');
//            $row->person = crm_Persons::fetchField($dRec->person, 'name') . " (" . $nick .")";
//        }
//
//        if($isPlain){
//            $row->person = strip_tags(($row->person instanceof core_ET) ? $row->person->getContent() : $row->person);
//        }
//
//        if(isset($dRec->num)) {
//            $row->num = $Int->toVerbal($dRec->num);
//        }
//
//        if(isset($dRec->indicatorId)) {
//            $row->indicator = hr_IndicatorNames::fetchField($dRec->indicatorId,'name');
//        }
//
//        if(isset($dRec->value)) {
//            $row->value = $Double->toVerbal($dRec->value);
//        }
//
//        return $row;
//    }
//
//
//    /**
//     * След рендиране на единичния изглед
//     *
//     * @param frame2_driver_Proto $Driver
//     * @param embed_Manager $Embedder
//     * @param core_ET $tpl
//     * @param stdClass $data
//     */
//    protected static function on_AfterRecToVerbal(frame2_driver_Proto $Driver, embed_Manager $Embedder, $row, $rec, $fields = array())
//    {
//        // потребителите
//        if(isset($rec->personId)){
//            $persons = keylist::toArray($rec->personId);
//            foreach ($persons as $userId => &$nick) {
//                $nick = crm_Profiles::createLink($userId)->getContent();
//            }
//
//            $row->persons = implode(', ', $persons);
//        }
//
//
//        if(isset($rec->periods)){
//            // избраният месец
//            $row->month = acc_Periods::fetchField("#id = '{$rec->periods}'", 'title');
//        }
//    }
//
//
//    /**
//     * След рендиране на единичния изглед
//     *
//     * @param cat_ProductDriver $Driver
//     * @param embed_Manager $Embedder
//     * @param core_ET $tpl
//     * @param stdClass $data
//     */
//    protected static function on_AfterRenderSingle(frame2_driver_Proto $Driver, embed_Manager $Embedder, &$tpl, $data)
//    {
//        $fieldTpl = new core_ET(tr("|*<!--ET_BEGIN BLOCK-->[#BLOCK#]
//								<fieldset class='detail-info'><legend class='groupTitle'><small><b>|Филтър|*</b></small></legend>
//							    <small><div><!--ET_BEGIN persons-->|Потребител|*: [#persons#]<!--ET_END persons--></div></small>
//                                <small><div><!--ET_BEGIN month-->|Месец|*: [#month#]<!--ET_END month--></div></small>
//                                </fieldset><!--ET_END BLOCK-->"));
//
//        if(isset($data->rec->personId)){
//            $fieldTpl->append($data->row->persons, 'persons');
//        }
//
//        if(isset($data->rec->periods)){
//            $fieldTpl->append($data->row->month, 'month');
//        }
//
//        $tpl->append($fieldTpl, 'DRIVER_FIELDS');
//    }
}