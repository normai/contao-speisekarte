<?php

namespace LinkingYou\ContaoSpeisekarte\DataContainer;

use Contao\CoreBundle\Framework\ContaoFramework;
use LinkingYou\ContaoSpeisekarte\Model\ContaoSpeisekarteZusatzstoffeModel;

class Zusatzstoffe {

    public function getZusatzstoffe() {

        $zusatzstoffe = ContaoSpeisekarteZusatzstoffeModel::findAll();

        $result = array();
        foreach ($zusatzstoffe as $zusatzstoff) {
            $result[$zusatzstoff->id] = '(' . $zusatzstoff->kuerzel . ') ' . $zusatzstoff->titel;
        }
        return $result;
    }

    public function getZusatzstofftitelById($id) {
        $zusatzstoff = ContaoSpeisekarteZusatzstoffeModel::findOneBy('id', $id);
        if ($zusatzstoff) {
            return $zusatzstoff->titel;
        } else {
            return null;
        }
    }

    public function getZusatzstoffkuerzelById($id) {
        $zusatzstoff = ContaoSpeisekarteZusatzstoffeModel::findOneBy('id', $id);
        if ($zusatzstoff) {
            return $zusatzstoff->kuerzel;
        } else {
            return null;
        }
    }


}
