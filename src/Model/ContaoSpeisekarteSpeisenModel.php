<?php

namespace LinkingYou\ContaoSpeisekarte\Model;

use Contao\Model;

class ContaoSpeisekarteSpeisenModel extends Model {

    /**
     * Name of the table
     * @var string
     */
    protected static $strTable = 'tl_contao_speisekarte_speisen';
    
    /**
     * Find published speisen by their parent ID
     *
     * @param integer $intPid     The speisen ID
     * @param array   $arrOptions An optional options array
     *
     * @return Collection|ContaoSpeisekarteSpeisenModel[]|ContaoSpeisekarteSpeisenModel|null A collection of models or null if there are no speisen
     */
    public static function findPublishedByPid($intPid, array $arrOptions=array())
    {
      $t = static::$strTable;
      $arrColumns = array("$t.pid=?");

      if (!static::isPreviewMode($arrOptions))
      {
        $arrColumns[] = "$t.published='1'";
      }

      // Skip unsaved elements (see #2708)
      $arrColumns[] = "$t.tstamp!=0";

      if (!isset($arrOptions['order']))
      {
        $arrOptions['order'] = "$t.sorting";
      }

      return static::findBy($arrColumns, $intPid, $arrOptions);
    }
}