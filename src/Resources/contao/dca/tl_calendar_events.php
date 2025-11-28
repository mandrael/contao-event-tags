<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

/**
 * 1. Feld-Definition: Event-Tags
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['event_tags'] = [
    'label'            => ['Event-Tags', 'Tags für dieses Event auswählen.'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['Mandrael\EventTagsBundle\TagsHelper', 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr', 
    ],
    'sql'              => "blob NULL",
];

/**
 * 2. Positionierung in der Palette
 */
if (isset($GLOBALS['TL_DCA']['tl_calendar_events']['palettes']) && is_array($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'])) {
    
    foreach ($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'] as $paletteName => $paletteDef) {
        
        if (!is_string($paletteDef)) {
            continue;
        }

        if (strpos($paletteDef, 'author') !== false) {
            PaletteManipulator::create()
                ->addField('event_tags', 'author', PaletteManipulator::POSITION_AFTER)
                ->applyToPalette($paletteName, 'tl_calendar_events');
        }
    }
}
