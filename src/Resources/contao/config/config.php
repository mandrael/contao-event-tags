<?php

// Backend-Modul für Tag-Verwaltung
$GLOBALS['BE_MOD']['content']['event_tags'] = [
    'tables' => ['tl_event_tags'],
    'icon'   => 'bundles/mandraeleventtags/icon.svg',
];

// Frontend-Modul: Eventliste mit Tag-Filter
$GLOBALS['FE_MOD']['events']['eventlist_tags'] = \Mandrael\EventTagsBundle\Module\ModuleEventlistTags::class;
