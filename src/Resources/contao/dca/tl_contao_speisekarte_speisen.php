<?php

$GLOBALS['TL_DCA']['tl_contao_speisekarte_speisen'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ptable' => 'tl_contao_speisekarte_kategorien',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 4,
            'fields'                  => array('sorting'),
            'flag'                    => 11,
            'panelLayout'             => 'search,limit',
            'child_record_callback'   => array('Speisen', 'getSpeisen'),
            'headerFields'            => array('titel')
        ),
        'label' => array
        (   'fields'                  => array('titel'),
            'format'                  => '%s'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array(
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['edit'],
                'href'                => 'act=edit',
                'icon' => 'edit.svg'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Select
    'select' => array
    (
        'buttons_callback' => array()
    ),

    // Edit
    'edit' => array
    (
        'buttons_callback' => array()
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'                => array(''),
        'default'                     => '{titel_legend},nummer,titel,beschreibung;{preise_legende},menge,preis,menge2,preis2,menge3,preis3,einheit,grundpreis;{zusatzstoffe_legende},zusatzstoffe,allergene;'
    ),

    // Subpalettes
    'subpalettes' => array
    (
        ''                            => ''
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'nummer' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['nummer'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'rgxp' => 'natural',
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "int(10) unsigned NULL"
        ),
        'titel' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['titel'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>true,
                'maxlength'=>255,
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'beschreibung' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['beschreibung'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array(
                'mandatory'=>false,
                'tl_class' => 'clr'
            ),
            'sql'                     => "text NULL"
        ),
        'menge' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['menge'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255,
                'rgxp' => 'digit',
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'preis' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['preis'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255,
                'rgxp' => 'digit',
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'menge2' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['menge'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255,
                'rgxp' => 'digit',
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'preis2' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['preis'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255,
                'rgxp' => 'digit',
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'menge3' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['menge'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255,
                'rgxp' => 'digit',
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'preis3' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['preis'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255,
                'rgxp' => 'digit',
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'einheit' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['einheit'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options' => array(
                'Liter',
                'g',
                'kg'
            ),
            'eval' => array(
                'includeBlankOption' => true,
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'grundpreis' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['grundpreis'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval' => array(
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "varchar(10) NOT NULL default ''"
        ),
        'zusatzstoffe' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['zusatzstoffe'],
            'exclude'                 => true,
            'inputType'               => 'checkboxWizard',
            'options_callback'        => function() {
                return \Contao\System::getContainer()->get('contao_speisekarte.zusatzstoffe')->getZusatzstoffe();
            },
            'eval'                    => array(
                'multiple'=>true,
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "text NULL"
            //'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'allergene' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['allergene'],
            'exclude'                 => true,
            'inputType'               => 'checkboxWizard',
            'options_callback'        => function() {
                return \Contao\System::getContainer()->get('contao_speisekarte.allergene')->getAllergene();
            },
            'eval'                    => array(
                'multiple'=>true,
                'tl_class'=>'w50 widget'
            ),
            'sql'                     => "text NULL"
            //'sql'                     => "varchar(255) NOT NULL default ''"
        )
    )
);

class Speisen {
    function getSpeisen($a) {
        return $a['titel'] . '<br />' . $a['beschreibung'];
    }
}
