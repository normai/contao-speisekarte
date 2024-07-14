<?php

/**
 * file : 20210729°1211 contao-speisekarte/src/Module/ModuleContaoSpeisekarte.php
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @copyright  Copyright (c) 2017, Frank Müller
 * @author     Frank Müller
 * @author     Modifications by Norbert C. Maier <https://github.com/normai/contao-speisekarte>
 * summary   : Sort foods by their backend order
 * version   :
 * version   : 20210803°1311 Sort foods by backend order
 * encoding  : UTF-8-without-BOM, UNIX-style-line-end '0x0a'
 */

namespace LinkingYou\ContaoSpeisekarte\Module;

use Contao\Module;
use LinkingYou\ContaoSpeisekarte\DataContainer\Allergene;
use LinkingYou\ContaoSpeisekarte\DataContainer\Zusatzstoffe;
use LinkingYou\ContaoSpeisekarte\Model\ContaoSpeisekarteKategorienModel;
use LinkingYou\ContaoSpeisekarte\Model\ContaoSpeisekarteSpeisenModel;

class ModuleContaoSpeisekarte extends Module {

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_contaospeisekarte_speisekarte';

    protected function compile()
    {

        $zusatzstoffe_service = \Contao\System::getContainer()->get('contao_speisekarte.zusatzstoffe');
        $allergene_service = \Contao\System::getContainer()->get('contao_speisekarte.allergene');

        $speisekarte = array();

        if ($this->contaospeisekarte_kategorien) {

            $kategorienObjekt = ContaoSpeisekarteKategorienModel::findMultipleByIds(unserialize($this->contaospeisekarte_kategorien));

            foreach($kategorienObjekt as $kategorie) {

                $speisenObjekt = ContaoSpeisekarteSpeisenModel::findPublishedByPid($kategorie->id);

                $speisenliste = array();
                $zusatstoffliste = array();
                $allergenliste = array();
                foreach ($speisenObjekt as $item) {

                    $speise = array();

                    // ---------------------------------
                    // Field for sorting after backend order [line 20210803°1231]
                    $speise["sorting"] = $item->sorting;
                    // ---------------------------------

                    // ---------------------------------
                    // Field for possible image [seq 20210806°0931]
                    $speise["imageurl"] = $item->dishpic;

                    // Todo 20210806°0933 : How to retrieve the image url from
                    //   the image id, or whatever this cryptic string is called?!


                    // ---------------------------------

                    $speise["titel"] = $item->titel;
                    
                    $speise["menge"] = $item->menge;
                    $speise["menge2"] = $item->menge2;
                    $speise["menge3"] = $item->menge3;

                    $speise["preis"] = $item->preis;
                    $speise["preis2"] = $item->preis2;
                    $speise["preis3"] = $item->preis3;
                    
                    if ($item->einheit) {
                        $speise["einheit"] = $GLOBALS['TL_LANG']['MSC']['contao_speisekarte']['einheit'][$item->einheit];
                    }
                    
                    if ($item->grundpreis && (floatval($item->menge) > 0)) {
                        $speise['grundpreis'] = ((float)$item->preis) / ((float)$item->menge);echo "aa";
                    } else {
                        $speise['grundpreis'] = null;
                    }
                    $speise["beschreibung"] = $item->beschreibung;

                    if ($item->zusatzstoffe) {
                        $tmp = array();
                        foreach (unserialize($item->zusatzstoffe) as $zusatzstoff_id) {
                            array_push($tmp, $zusatzstoffe_service->getZusatzstoffkuerzelById($zusatzstoff_id));

                            // Hier die Kürzel der Zusatzstoffe pro Speise rein
                            $zusatstoffliste[ $zusatzstoffe_service->getZusatzstoffkuerzelById($zusatzstoff_id)] = $zusatzstoffe_service->getZusatzstoffkuerzelById($zusatzstoff_id) . ' = ' . $zusatzstoffe_service->getZusatzstofftitelById($zusatzstoff_id);
                        }
                        $speise["zusatzstoffe"] = implode(', ', $tmp);
                    }

                    if ($item->allergene) {
                        $tmp = array();
                        foreach (unserialize($item->allergene) as $allergen_id) {
                            array_push($tmp, $allergene_service->getAllergenKuerzelById($allergen_id));

                            // Hier die Kürzel der Allergene pro Speise rein
                            $allergenliste[ $allergene_service->getAllergenKuerzelById($allergen_id)] = $allergene_service->getAllergenkuerzelById($allergen_id) . ' = ' . $allergene_service->getAllergenTitelById($allergen_id);
                        }
                        $speise["allergene"] = implode(', ', $tmp);
                    }

                    $speisenliste[] = $speise;
                }

                //--------------------------------------
                // Debug output [line 20210729°1121 ncm]
                if (FALSE) {
                    print_r($speisenliste);
                }

                // Do the sorting [seq 20210729°1231]
                // Note : This is done late. It could be done earlier, notably at the SQL query.
                if (TRUE) {
                    $bSuccess = usort($speisenliste, 'self::sortBySorting');
                }

                // Debug output [seq 20210729°1122]
                if (FALSE) {                                           //// FALSE TRUE
                   print_r('Success = ');
                   print_r($bSuccess ? 'true' : 'false');
                   print_r('Speisenliste = ');
                   print_r($speisenliste);
                }
                //--------------------------------------

                asort($zusatstoffliste);

                $speisekarte[] = array (
                    'kategorie'        => $kategorie->titel,
                    'speisenliste'     => $speisenliste,
                    'zusatzstoffliste' => implode(', ', $zusatstoffliste),
                    'allergenliste'    => implode(',', $allergenliste)
                );
            }

            $this->Template->speisekarte = $speisekarte;
        }
    }

    /**
     * Function for sorting the dishes
     *
     * • Perhaps this functionality could even be done without any code,
     *   just by definitions in dca/tl_contao_speisekarte_speisen.php
     *
     * • This function could as well (or rather) be implemented
     *   as an anonymous function at the location of use.
     *
     * id : func 20210729°1221
     */
    public static function sortBySorting($a, $b) {

        // Debug output [seq 20210729°1227]
        if (FALSE) {
            print_r('SORT : ' . $a['sorting'] . ' vs. ' . $b['sorting'] . " -- <br>\n");
        }

        if ($a['sorting'] == $b['sorting']) {
            return 0;
        }
        return ($a['sorting'] < $b['sorting']) ? -1 : 1;
    }
}
