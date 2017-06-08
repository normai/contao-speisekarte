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

            $kategorien = ContaoSpeisekarteKategorienModel::findMultipleByIds(unserialize($this->contaospeisekarte_kategorien));

            foreach($kategorien as $kategorie) {

                $liste = array();
                $liste['kategorie'] = $kategorie->title;

                $speisen = ContaoSpeisekarteSpeisenModel::findBy(
                    'pid',
                    $kategorie->id
                );
                $liste['speisen'] = $speisen;

                $speisekarte[] = $liste;
            }

            $this->Template->speisekarte = $speisekarte;
        }



    }

}