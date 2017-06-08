<?php

namespace LinkingYou\ContaoSpeisekarte\DataContainer;

use Contao\CoreBundle\Framework\ContaoFramework;
use LinkingYou\ContaoSpeisekarte\Model\ContaoSpeisekarteZusatzstoffeModel;

class Zusatzstoffe {

    public function getZusatzstoffe() {

        $zusatzstoffe = ContaoSpeisekarteZusatzstoffeModel::findAll();

        $result = array();
        foreach ($zusatzstoffe as $zusatzstoff) {
            $result[] = $zusatzstoff->kuerzel . ' ' . $zusatzstoff->title;
        }
        return $result;
    }

}