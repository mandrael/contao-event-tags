<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

// 1. Feld-Definition
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['event_tags'] = [
    'label'            => ['Tags', 'Tags für dieses Event auswählen.'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['Mandrael\EventTagsBundle\TagsHelper', 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr w50',
    ],
    'sql'              => "blob NULL",
];

$manipulator = PaletteManipulator::create()
    ->addField('event_tags', 'author', PaletteManipulator::POSITION_AFTER);

// Liste der Paletten, die wir bearbeiten wollen
$targetPalettes = ['default', 'internal', 'article', 'external'];

// Wir gehen die Liste durch und wenden den Manipulator NUR an, 
// wenn die Palette auch wirklich existiert.
foreach ($targetPalettes as $paletteName) {
    if (isset($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'][$paletteName])) {
        $manipulator->applyToPalette($paletteName, 'tl_calendar_events');
    }
}
