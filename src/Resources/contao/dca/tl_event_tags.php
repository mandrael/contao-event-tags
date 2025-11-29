<?php

$GLOBALS['TL_DCA']['tl_event_tags'] = [
    'config' => [
        'dataContainer' => 'DC_Table',
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
            'fields' => ['title'],
            'format' => '%s',
        ],
        'global_operations' => [
            'all' => [
                'label'      => ['Alle', 'Mehrere Datensätze bearbeiten'],
                'href'       => 'act=select',
                'class'      => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()"',
            ],
        ],
        'operations' => [
            'edit' => [
                'label' => ['Bearbeiten', 'Tag bearbeiten'],
                'href'  => 'act=edit',
                'icon'  => 'edit.svg',
            ],
            'delete' => [
                'label'      => ['Löschen', 'Tag löschen'],
                'href'       => 'act=delete',
                'icon'       => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\'Wirklich löschen?\'))return false;Backend.getScrollOffset()"',
            ],
            'show' => [
                'label' => ['Details', 'Tag-Details anzeigen'],
                'href'  => 'act=show',
                'icon'  => 'show.svg',
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
            'label'     => ['Titel', 'Name des Tags'],
            'inputType' => 'text',
            'eval'      => ['mandatory' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
            'sql'       => "varchar(128) NOT NULL default ''",
        ],
    ],
];
