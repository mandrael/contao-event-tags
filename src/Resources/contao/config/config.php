<?php

/**
 * ---------------------------------------------------------------
 * Backend-Module Registrierung
 * ---------------------------------------------------------------
 */
$GLOBALS['BE_MOD']['content']['event_tags'] = [
    'tables' => ['tl_event_tags'],
];

/**
 * ---------------------------------------------------------------
 * Frontend-Module Registrierung
 * ---------------------------------------------------------------
 */
$GLOBALS['FE_MOD']['events']['eventlist_tags'] = 'Mandrael\EventTagsBundle\Module\ModuleEventlistTags';
