<?php

namespace LinkingYou\ContaoSpeisekarte\Module;

use Contao\Module;
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

        $speisekarte = array();

        if ($this->contaospeisekarte_kategorien) {

            $kategorienObjekt = ContaoSpeisekarteKategorienModel::findMultipleByIds(unserialize($this->contaospeisekarte_kategorien));

            foreach($kategorienObjekt as $kategorie) {

                $liste = array();
                $liste['kategorie'] = $kategorie->titel;

                $speisenObjekt = ContaoSpeisekarteSpeisenModel::findBy(
                    'pid',
                    $kategorie->id
                );

                $speisen = array();
                foreach ($speisenObjekt as $item) {
                    $speise = array();
                    $speise["titel"] = $item->titel;
                    if ($item->preis) {
                        $speise["preis"] = number_format($item->preis,2,',','.');
                    } else {
                        $speise["preis"] = null;
                    }
                    $speise["beschreibung"] = $item->beschreibung;

                    if ($item->zusatzstoffe) {
                        var_dump(($item->zusatzstoffe));
                    }

                    $speisen[] = $speise;
                }

                $liste['speisen'] = $speisen;

                $speisekarte[] = $liste;
            }

            $this->Template->speisekarte = $speisekarte;
        }



    }

}