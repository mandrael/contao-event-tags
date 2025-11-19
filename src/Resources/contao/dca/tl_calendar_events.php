<?php

// Legend hinzufügen, falls noch nicht vorhanden
foreach ($GLOBALS['TL_DCA']['tl_calendar_events']['palettes'] as $paletteKey => $paletteDef) {
    if (!is_string($paletteDef)) {
        continue;
    }
    if (strpos($paletteDef, '{tags_legend') === false) {
        $GLOBALS['TL_DCA']['tl_calendar_events']['palettes'][$paletteKey] .= ';{tags_legend},event_tags';
    }
}

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['event_tags'] = [
    'label'            => ['Tags', 'Tags für dieses Event'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['Mandrael\\EventTagsBundle\\TagsHelper', 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr w50',
    ],
    'sql'              => "blob NULL",
];
