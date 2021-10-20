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

                $speisenObjekt = ContaoSpeisekarteSpeisenModel::findBy(
                    'pid',
                    $kategorie->id
                );

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
                    if ($item->menge) {
                        $speise["menge"] = $item->menge;
                    } else {
                        $speise["menge"] = null;
                    }
                    if ($item->preis) {
                        // Why does the Contao debugger not complain about the missing
                        //  float cast here, as it does below? [note 20210729°1114]
                        $speise["preis"] = number_format($item->preis, 2, ',', '.');
                    } else {
                        $speise["preis"] = null;
                    }
                    if ($item->einheit) {
                        $speise["einheit"] = $item->einheit;
                    } else {
                        $speise["einheit"] = null;
                    }
                    if ($item->menge) {
                        $speise["menge2"] = $item->menge2;
                    } else {
                        $speise["menge2"] = null;
                    }
                    if ($item->preis) {
                        // [Fix 20210729°1111 see ss 20210729°1112] Add '(float)' to avoid Contao debugger
                        // "Warning: number_format() expects parameter 1 to be float, string given"
                        $speise["preis2"] = number_format( (float) $item->preis2, 2, ',', '.');
                    } else {
                        $speise["preis2"] = null;
                    }
                    if ($item->menge) {
                        $speise["menge3"] = $item->menge3;
                    } else {
                        $speise["menge3"] = null;
                    }
                    if ($item->preis) {
                        // [Fix 20210729°1113] Add '(float)', same as in above fix 20210729°1111
                        $speise["preis3"] = number_format( (float) $item->preis3, 2, ',', '.');
                    } else {
                        $speise["preis3"] = null;
                    }
                    if ($item->grundpreis && (floatval($item->menge) > 0)) {
                        $speise['grundpreis'] = number_format($item->preis / $item->menge, 2, ',', '.');
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
                            array_push($tmp, $allergene_service->getAllergenkuerzelById($allergen_id));

                            // Hier die Kürzel der Allergene pro Speise rein
                            $allergenliste[ $allergene_service->getAllergenkuerzelById($allergen_id)] = $allergene_service->getAllergenkuerzelById($allergen_id) . ' = ' . $allergene_service->getAllergentitelById($allergen_id);
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
                if (FALSE) {
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
