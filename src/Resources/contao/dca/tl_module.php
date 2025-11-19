<?php

// Tag-Filter-Feld an Eventlisten-Module anhängen
if (isset($GLOBALS['TL_DCA']['tl_module']['palettes']['eventlist'])) {
    $GLOBALS['TL_DCA']['tl_module']['palettes']['eventlist'] .= ';{tags_legend},filter_event_tags';
}

$GLOBALS['TL_DCA']['tl_module']['fields']['filter_event_tags'] = [
    'label'            => ['Tags filtern', 'Es werden nur Events mit diesen Tags angezeigt'],
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
