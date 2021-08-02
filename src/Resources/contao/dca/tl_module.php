<?php

/**
 * add palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['contao_speisekarte_speisekarte'] = '{title_legend},name,headline,type;{contaospeisekarte_legend},contaospeisekarte_kategorien,contaospeisekarte_zusatzstoffe,contaospeisekarte_allergene';

/**
 * add fields
 */

$GLOBALS['TL_DCA']['tl_module']['fields']['contaospeisekarte_kategorien'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['contaospeisekarte_kategorien'],
    'exclude'                 => true,
    'inputType'               => 'checkboxWizard',
    'foreignKey' => 'tl_contao_speisekarte_kategorien.titel',
    'relation' => array(
        'type' => 'belongsTo',
        'table' => 'tl_contao_speisekarte_kategorien',
        'field' => 'id'
    ),
    'eval' => array(
        'multiple' => true,
        'mandatory' => false
    ),
    'sql' =>  "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['contaospeisekarte_zusatzstoffe'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['contaospeisekarte_zusatzstoffe'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'sql' => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['contaospeisekarte_allergene'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['contaospeisekarte_allergene'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'sql' => "int(10) unsigned NOT NULL default '0'"
);
