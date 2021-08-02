<?php

/**
 * Contao-Speisekarte Extension for Contao Open Source
 *
 * @copyright  Copyright (c) 2017, Frank Müller
 * @author     Frank Müller <frank.mueller@linking-you.de>
 * @license    http://opensource.org/licenses/lgpl-3.0.html LGPL
 */

/*
* Backend modules
*/
$GLOBALS['BE_MOD']['contao_speisekarte'] = array(
    'contao_speisekarte_speisen' => array(
        'tables'       => array(
            'tl_contao_speisekarte_kategorien',
            'tl_contao_speisekarte_speisen'
        )
    ),
    'contao_speisekarte_zusatzstoffe' => array(
        'tables' => array(
            'tl_contao_speisekarte_zusatzstoffe'
        )
    ),
    'contao_speisekarte_allergene' => array(
        'tables' => array(
            'tl_contao_speisekarte_allergene'
        )
    )
);

/* Models */
$GLOBALS['TL_MODELS']['tl_contao_speisekarte_speisen'] = 'LinkingYou\\ContaoSpeisekarte\\Model\\ContaoSpeisekarteSpeisenModel';
$GLOBALS['TL_MODELS']['tl_contao_speisekarte_zusatzstoffe'] = 'LinkingYou\\ContaoSpeisekarte\\Model\\ContaoSpeisekarteZusatzstoffeModel';
$GLOBALS['TL_MODELS']['tl_contao_speisekarte_allergene'] = 'LinkingYou\\ContaoSpeisekarte\\Model\\ContaoSpeisekarteAllergeneModel';
$GLOBALS['TL_MODELS']['tl_contao_speisekarte_kategorien'] = 'LinkingYou\\ContaoSpeisekarte\\Model\\ContaoSpeisekarteKategorienModel';

/*
 * Frontend modules
 */
$GLOBALS['FE_MOD']['contao_speisekarte']['contao_speisekarte_speisekarte'] ='LinkingYou\\ContaoSpeisekarte\\Module\\ModuleContaoSpeisekarte';
