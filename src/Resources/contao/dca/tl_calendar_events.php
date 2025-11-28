<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

// 1. Feld-Definition (wie gehabt)
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['event_tags'] = [
    'label'            => ['Tags', 'Tags für dieses Event auswählen.'],
    'exclude'          => true,
    'inputType'        => 'select',
    // Hier binden wir den Helper ein (Service-Schreibweise oder statisch, je nachdem was du gewählt hast)
    // Wenn du services.yaml nutzt: [Mandrael\EventTagsBundle\TagsHelper::class, 'getTags']
    // Wenn du es klassisch hast: ['Mandrael\EventTagsBundle\TagsHelper', 'getTags']
    'options_callback' => ['Mandrael\EventTagsBundle\TagsHelper', 'getTags'],
    'eval'             => [
        'multiple' => true, // Mehrfachauswahl
        'chosen'   => true, // Aktiviert die Suche ("Schreiben und bestätigen")
        'tl_class' => 'clr w50',
    ],
    'sql'              => "blob NULL",
];

// 2. Positionierung: Feld 'event_tags' NACH 'author' einfügen
// Wir nutzen den PaletteManipulator, das ist der sauberste Weg für Contao 4.13 & 5.3
PaletteManipulator::create()
    ->addField('event_tags', 'author', PaletteManipulator::POSITION_AFTER)
    ->applyToPalette('default', 'tl_calendar_events')
    ->applyToPalette('internal', 'tl_calendar_events')
    ->applyToPalette('article', 'tl_calendar_events')
    ->applyToPalette('external', 'tl_calendar_events');
