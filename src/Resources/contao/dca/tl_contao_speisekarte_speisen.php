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
            'mode'                    => 1,
            'fields'                  => array('title'),
            'flag'                    => 1,
            'panelLayout'             => 'search,limit'
        ),
        'label' => array
        (            'fields'                  => array('title'),
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
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_slick']['edit'],
                'href'                => 'act=edit',
                'icon' => 'edit.svg'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_slick']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_slick']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_contao_slick']['show'],
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
        'default'                     => '{title_legend},number,title,description,price;'
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
        'number' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_slick']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'rgxp' => 'natural'
            ),
            'sql'                     => "int(10) unsigned NULL"
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_slick']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'description' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_slick']['title'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255
            ),
            'sql'                     => "text NOT NULL"
        ),
        'price' => array(
            'label'                   => &$GLOBALS['TL_LANG']['tl_contao_slick']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array(
                'mandatory'=>false,
                'maxlength'=>255,
                'rgxp' => 'digit'
            ),
            'sql'                     => "varchar(255) NOT NULL default ''"
        )

    )
);