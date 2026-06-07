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
        'default' => '{title_legend},title;',
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
    ],
];
