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
    'speisen' => array(
        'tables'       => array(
            'tl_contao_speisekarte_kategorien',
            'tl_contao_speisekarte_speisen'
        )
    ),
    'zusatzstoffe' => array(
        'tables' => array(
            'tl_contao_speisekarte_zusatzstoffe'
        )
    ),
    'allergene' => array(
        'tables' => array(
            'tl_contao_speisekarte_allergene'
        )
    )
);

