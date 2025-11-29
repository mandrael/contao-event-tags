<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

/**
 * --------------------------------------------------------------------------
 * Feld: event_tags
 * --------------------------------------------------------------------------
 * Mehrfachauswahl, Speicherung als TEXT (lesbares serialisiertes Array).
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['event_tags'] = [
    'label'            => ['Event-Tags', 'Tags für dieses Event auswählen.'],
    'exclude'          => true,
    'inputType'        => 'select',
    // Einheitliche Schreibweise mit ::class (wie im Modul)
    'options_callback' => [Mandrael\EventTagsBundle\Helper\TagsHelper::class, 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr', // volle Breite
    ],
    // WICHTIGE ÄNDERUNG: TEXT statt BLOB für bessere Handhabung
    'sql'              => "text NULL",
];

/**
 * --------------------------------------------------------------------------
 * Positionierung in allen Paletten: direkt NACH "author"
 * --------------------------------------------------------------------------
 */
if (isset($GLOBALS['TL_DCA']['tl_calendar_events']['palettes']) && is_array($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'])) {
    
    foreach ($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'] as $paletteName => $paletteDef) {
        
        // Die besondere __selector__-Palette und Arrays nicht anfassen
        if ('__selector__' === $paletteName || !is_string($paletteDef)) {
            continue;
        }

        // Wir suchen 'author' und hängen uns direkt dahinter
        if (strpos($paletteDef, 'author') !== false) {
            PaletteManipulator::create()
                ->addField('event_tags', 'author', PaletteManipulator::POSITION_AFTER)
                ->applyToPalette($paletteName, 'tl_calendar_events');
        }
        // Fallback: Falls 'author' fehlt, nehmen wir 'title'
        elseif (strpos($paletteDef, 'title') !== false) {
             PaletteManipulator::create()
                ->addField('event_tags', 'title', PaletteManipulator::POSITION_AFTER)
                ->applyToPalette($paletteName, 'tl_calendar_events');
        }
    }
}
