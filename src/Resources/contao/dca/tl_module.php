<?php

/**
 * Palette für das eigene Modul "eventlist_tags"
 * * ÄNDERUNG: 'filter_event_tags' wurde direkt hinter 'type' geschoben.
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['eventlist_tags'] = 
    '{title_legend},name,headline,type,filter_event_tags;' . // Hier steht es jetzt direkt nach dem Typ
    '{config_legend},cal_calendar;' . 
    '{redirect_legend},jumpTo;' . 
    '{template_legend:hide},customTpl;' . 
    '{protected_legend:hide},protected;' . 
    '{expert_legend:hide},guests,cssID;' . 
    '{invisible_legend:hide},invisible,start,stop';

/**
 * Feld: filter_event_tags
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['filter_event_tags'] = [
    'label'            => ['Nach Tags filtern', 'Es werden nur Events mit diesen Tags angezeigt.'],
    'exclude'          => true,
    'inputType'        => 'select',
    // Namespace angepasst auf deine Struktur (Helper Ordner)
    'options_callback' => [Mandrael\EventTagsBundle\Helper\TagsHelper::class, 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr', // volle Breite
    ],
    // SQL-Definition (Array-Schreibweise für beste Kompatibilität)
    'sql'              => [
        'type'    => 'blob',
        'length'  => 65535,
        'notnull' => false,
    ],
];
