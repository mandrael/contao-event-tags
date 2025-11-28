<?php

use Doctrine\DBAL\Platforms\MySQLPlatform;

/**
 * --------------------------------------------------------------------------
 * Feld: filter_event_tags
 * --------------------------------------------------------------------------
 * Wird im Frontend-Modul „Eventliste (mit Tag-Filter)“ verwendet.
 * Speicherung als BLOB, kompatibel mit Contao 4.13 und 5.3.
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['filter_event_tags'] = [
    'label'            => ['Tags filtern', 'Es werden nur Events angezeigt, die mindestens einen dieser Tags besitzen.'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['Mandrael\\EventTagsBundle\\TagsHelper', 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr w50',
    ],
    'sql'              => [
        'type'    => 'blob',
        'length'  => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
];

/**
 * --------------------------------------------------------------------------
 * Integration des Feldes in das FE-Modul "eventlist_tags"
 * --------------------------------------------------------------------------
 * Das Modul wird im config.php registriert und erhält hier die Felder.
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['eventlist_tags']
    = str_replace(
        'cal_calendar', 
        'cal_calendar,filter_event_tags',
        $GLOBALS['TL_DCA']['tl_module']['palettes']['eventlist'] ?? 'cal_calendar,filter_event_tags'
    );
