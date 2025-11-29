<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

/**
 * Feld-Definition (wie gehabt)
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['filter_event_tags'] = [
    'label'            => ['Nach Tags filtern', 'Nur Events mit diesen Tags anzeigen.'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [Mandrael\EventTagsBundle\Helper\TagsHelper::class, 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr',
    ],
    'sql'              => [
        'type'    => 'blob',
        'length'  => 65535,
        'notnull' => false,
    ],
];

/**
 * Positionierung: Wir hängen es in die STANDARD 'eventlist'
 * Direkt nach der Kalender-Auswahl.
 */
PaletteManipulator::create()
    ->addField('filter_event_tags', 'cal_calendar', PaletteManipulator::POSITION_AFTER)
    ->applyToPalette('eventlist', 'tl_module');
