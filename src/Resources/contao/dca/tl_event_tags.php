<?php

use Contao\DC_Table;
use Mandrael\EventTagsBundle\EventListener\TagLabelListener;

$GLOBALS['TL_DCA']['tl_event_tags'] = [
    'config' => [
        'dataContainer'    => DC_Table::class,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id'    => 'primary',
                'title' => 'index',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode'   => 1,
            'fields' => ['title'],
            'flag'   => 1,
        ],
        'label' => [
            'fields'         => ['title'],
            'format'         => '%s',
            'label_callback' => [TagLabelListener::class, '__invoke'],
        ],
        'global_operations' => [
            'all' => [
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
            ],
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg',
            ],
            'delete' => [
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'' . addslashes($GLOBALS['TL_LANG']['MSC']['eventTagsDeleteConfirm'] ?? '') . '\'))return false;Backend.getScrollOffset()"',
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg',
            ],
        ],
    ],

    'palettes' => [
        'default' => '{title_legend},title,color,icon;',
    ],

    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ],

        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],

        'title' => [
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],

        'color' => [
            'inputType' => 'text',
            'eval'      => ['maxlength' => 6, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard'],
            'sql'       => "varchar(6) NOT NULL default ''",
        ],

        'icon' => [
            'inputType' => 'fileTree',
            'eval'      => ['filesOnly' => true, 'fieldType' => 'radio', 'extensions' => 'svg,png,jpg,jpeg,gif,webp', 'tl_class' => 'w50'],
            'sql'       => "binary(16) NULL",
        ],
    ],
];
