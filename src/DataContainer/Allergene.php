<?php

namespace LinkingYou\ContaoSpeisekarte\DataContainer;

use Contao\CoreBundle\Framework\ContaoFramework;
use LinkingYou\ContaoSpeisekarte\Model\ContaoSpeisekarteAllergeneModel;

class Allergene {

    public function getAllergene() {

        $allergene = ContaoSpeisekarteAllergeneModel::findAll();

        $result = array();
        foreach ($allergene as $allergen) {
            $result[] = $allergen->title;
        }
        return $result;
    }

}