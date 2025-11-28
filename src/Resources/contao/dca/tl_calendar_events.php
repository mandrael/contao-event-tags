<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Doctrine\DBAL\Platforms\MySQLPlatform;

/**
 * --------------------------------------------------------------------------
 * Feld: event_tags
 * --------------------------------------------------------------------------
 * Mehrfachauswahl, Speicherung als BLOB – kompatibel mit Contao 4.13 und 5.3.
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['event_tags'] = [
    'label'            => ['Event-Tags', 'Tags für dieses Event auswählen.'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['Mandrael\EventTagsBundle\Helper\TagsHelper', 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr',
    ],
    'sql'              => [
        'type'    => 'blob',
        'length'  => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
];

/**
 * --------------------------------------------------------------------------
 * Positionierung in allen Paletten: direkt NACH "author"
 * --------------------------------------------------------------------------
 */
if (
    isset($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'])
    && is_array($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'])
) {
    foreach ($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'] as $paletteName => $paletteDef) {
        // Die besondere __selector__-Palette nicht anfassen
        if ('__selector__' === $paletteName || !is_string($paletteDef)) {
            continue;
        }

        if (strpos($paletteDef, 'author') !== false) {
            PaletteManipulator::create()
                ->addField('event_tags', 'author', PaletteManipulator::POSITION_AFTER)
                ->applyToPalette($paletteName, 'tl_calendar_events');
        }
    }
}
