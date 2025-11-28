<?php

use Doctrine\DBAL\Platforms\MySQLPlatform;

/**
 * Palette für das eigene Modul "eventlist_tags"
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['eventlist_tags'] =
    '{title_legend},name,headline,type;
     {config_legend},cal_calendar,filter_event_tags;
     {redirect_legend},jumpTo;
     {template_legend:hide},customTpl;
     {protected_legend:hide},protected;
     {expert_legend:hide},guests,cssID;
     {invisible_legend:hide},invisible,start,stop';


/**
 * Feld: filter_event_tags
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['filter_event_tags'] = [
    'label'            => ['Nach Tags filtern', 'Es werden nur Events mit diesen Tags angezeigt'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['Mandrael\\EventTagsBundle\\Helper\\TagsHelper', 'getTags'],
    'eval'             => [
        'multiple' => true,
        'chosen'   => true,
        'tl_class' => 'clr', // volle Breite
    ],
    'sql'              => [
        'type'    => 'blob',
        'length'  => MySQLPlatform::LENGTH_LIMIT_BLOB,
        'notnull' => false,
    ],
];
