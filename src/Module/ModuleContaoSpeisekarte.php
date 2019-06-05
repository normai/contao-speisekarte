<?php

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
                    $speise["titel"] = $item->titel;
                    if ($item->menge) {
                        $speise["menge"] = $item->menge;
                    } else {
                        $speise["menge"] = null;
                    }
                    if ($item->preis) {
                        $speise["preis"] = number_format($item->preis,2,',','.');
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
                        $speise["preis2"] = number_format($item->preis2,2,',','.');
                    } else {
                        $speise["preis2"] = null;
                    }
                    if ($item->menge) {
                        $speise["menge3"] = $item->menge3;
                    } else {
                        $speise["menge3"] = null;
                    }
                    if ($item->preis) {
                        $speise["preis3"] = number_format($item->preis3,2,',','.');
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

                asort($zusatstoffliste);

                $speisekarte[] = array(
                    'kategorie' => $kategorie->titel,
                    'speisenliste'=> $speisenliste,
                    'zusatzstoffliste' => implode(', ', $zusatstoffliste),
                    'allergenliste' => implode(',', $allergenliste)
                );
            }

            $this->Template->speisekarte = $speisekarte;
        }



    }

}