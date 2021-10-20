<?php

/**
 *  file       : 20210805°0911 dca/tl_contao_speisekarte_speisen.php
 *  version    : • chg 20210805°0921 Edit dishes with TinyMCE
 *  version    : ////• seq 20210805°0931 Allow for defining an image per dish -- Not functioning
 *  reference  : e.g. https://docs.contao.org/dev/reference/dca/ [ref 20210805°1022]
 *  note       : 20210806°0911 Start implementing image
 */

$GLOBALS['TL_DCA']['tl_contao_speisekarte_speisen'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_contao_speisekarte_kategorien',
        'enableVersioning'            => true,
        'sql'                         => array
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
        (
            'fields'                  => array('titel'),
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
                'icon'                => 'edit.svg'
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
        ////'default'                 => '{titel_legend},nummer,titel,beschreibung;{Bild},picture;{Preise},menge,preis,menge2,preis2,menge3,preis3,einheit,grundpreis;{zusatzstoffe_legende},zusatzstoffe,allergene;'
        'default'                     => '{titel_legend},nummer,titel,beschreibung;{Bild},dishpic;{Preise},menge,preis,menge2,preis2,menge3,preis3,einheit,grundpreis;{zusatzstoffe_legende},zusatzstoffe,allergene;'
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
                'mandatory' => false,
                'rgxp'      => 'natural',
                'tl_class'  => 'w50 widget'
            ),
            'sql'                     => "int(10) unsigned NULL"
        ),
        'titel' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['titel'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory' => true,
                'maxlength' => 255,
                'tl_class'  => 'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),

        // Edit dish with TinyMCE [chg 20210805°0921]
        'beschreibung' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['beschreibung'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array (
                // 'mandatory' => false,                               // shutdown 20210805°092211
                'tl_class'   => 'clr',
                'allowHtml'  => true,                                  // added 20210805°092212
                'cols'       => 110,                                   // added 20210805°092213
                'feEditable' => true,                                  // added 20210805°092214
                'feViewable' => true,                                  // added 20210805°092215
                'preserveTags' => false,                               // added 20210805°092216
                'rows'       => 4,                                     // added 20210805°092217
                'rte'        => 'tinyMCE'                              // added 20210805°092218 'rich text editor'
             ),
            'sql'                     => "varchar(10000) NOT NULL default ''"  // added 20210805°092119
        ),

 /*
        // Allow for defining an image per dish [seq 20210805°0931]
        // Status : Not working
        'picture'                     => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['picture'],
            'fields'                  => array
            (
                'image'               => array
                (
                    'label'           => array('Bild', ''),
                    'inputType'       => 'fileTree',
                    'eval'            => array
                    (
                        'fieldType'   => 'radio',
                        'filesOnly'   => true,
                        'extensions'  => \Config::get('validImageTypes'),
                        'tl_class'    => 'clr',
                    ),
                ),
            ),
            'sql'                     => "blob ''"
         ),
 */

        // Allow for defining an image per dish [seq 20210806°0913 (after 20210805°0931)]
        // Ref : https://docs.contao.org/dev/reference/dca/fields/
        // Demo snippets search 'validImageTypes' e.g. in
        //    • G:\work\kampuni\contao4xtm\trunk\htdocs\vendor\contao\calendar-bundle\src\Resources\contao\dca\tl_calendar_events.php
        ////'picture'                 => array
        'dishpic'                     => array                                  // Choose a unique field name, 'picture' is found in 111 files
        (
            ////'label'               => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['picture'],
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['dishpic'], // Choose a unique field name, 'picture' is found in 111 files
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array
            (
                'fieldType'           => 'radio',                               // Select only one, not multiple as with checkbox
                'filesOnly'           => true,                                  // Avoid selecting a folder
                'extensions'          => \Config::get('validImageTypes'),       // Limit file tree to certain file types
                'tl_class'            => 'clr',                                 // Add the given CSS class(es) to the generated HTML
                'mandatory'           => true                                   // If true the field cannot be empty

                ////'fieldType'       => 'radio',                               // Select only one, not multiple as with checkbox
                ////'files'           => true                                   // after outdated https://docs.contao.org/books/cookbook/en/custom-module/part2.html
                ////'filesOnly'       => true,                                  // Avoid selecting a folder
            ),
            ////'sql'                 => "blob ''"
            'sql'                     => "binary(16) NULL"                      // ? The cryptic image id
        ),


        // // Demo snippet from one of 15 files found by searching for 'validImageTypes'
        // //  G:\work\kampuni\contao4xtm\trunk\htdocs\vendor\contao\calendar-bundle\src\Resources\contao\dca\tl_calendar_events.php
        // 'singleSRC' => array
        // (
        //    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['singleSRC'],
        //    'exclude'                 => true,
        //    'inputType'               => 'fileTree',
        //    'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'extensions'=>Config::get('validImageTypes'), 'mandatory'=>true),
        //    'sql'                     => "binary(16) NULL"
        // ),



        'menge' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['menge'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory' => false,
                'maxlength' => 255,
                'rgxp' => 'digit',
                'tl_class' => 'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'preis' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['preis'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'           => false,
                'maxlength'           => 255,
                'rgxp'                => 'digit',
                'tl_class'            => 'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'menge2' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['menge'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory' => false,
                'maxlength' => 255,
                'rgxp' => 'digit',
                'tl_class' => 'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'preis2' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['preis'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory' => false,
                'maxlength' => 255,
                'rgxp' => 'digit',
                'tl_class' => 'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'menge3' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['menge'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory' => false,
                'maxlength' => 255,
                'rgxp' => 'digit',
                'tl_class' => 'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'preis3' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['preis'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory' => false,
                'maxlength' => 255,
                'rgxp' => 'digit',
                'tl_class' => 'w50 widget'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'einheit' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['einheit'],
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => array (
                                            'Liter',
                                            'g',       // possibly superfluous
                                            'kg',      // possibly superfluous
                                            'Stk'
            ),
            'eval'                    => array (
                                             'includeBlankOption' => true,
                                             'tl_class'           => 'w50 widget'
                                         ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'grundpreis' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['grundpreis'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval' => array(
                'tl_class' => 'w50 widget'
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
                'multiple' => true,
                'tl_class' => 'w50 widget'
            ),
            //'sql'                   => "varchar(255) NOT NULL default ''"
            'sql'                     => "text NULL"
        ),
        'allergene' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_speisekarte_speisen']['allergene'],
            'exclude'                 => true,
            'inputType'               => 'checkboxWizard',
            'options_callback'        => function() {
                return \Contao\System::getContainer()->get('contao_speisekarte.allergene')->getAllergene();
            },
            'eval'                    => array(
                'multiple' => true,
                'tl_class' => 'w50 widget'
            ),
            //'sql'                   => "varchar(255) NOT NULL default ''"
            'sql'                     => "text NULL"
        )
    )
);

class Speisen {
    function getSpeisen($a) {
        return $a['titel'] . '<br />' . $a['beschreibung'];
    }
}
