<?php

use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Mandrael\EventTagsBundle\Helper\TagsHelper;

$GLOBALS['TL_DCA']['tl_module']['fields']['filter_event_tags'] = [
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [TagsHelper::class, 'getTags'],
    'eval'             => ['multiple' => true, 'chosen' => true, 'tl_class' => 'clr'],
    'sql'              => "text NULL",
];

$GLOBALS['TL_DCA']['tl_module']['fields']['filter_event_tags_logic'] = [
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => ['OR', 'AND'],
    'reference' => &$GLOBALS['TL_LANG']['tl_module']['filter_event_tags_logic_options'],
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "varchar(3) NOT NULL default 'OR'",
];

PaletteManipulator::create()
    ->addField('filter_event_tags', 'cal_calendar', PaletteManipulator::POSITION_AFTER)
    ->addField('filter_event_tags_logic', 'filter_event_tags', PaletteManipulator::POSITION_AFTER)
    ->applyToPalette('eventlist', 'tl_module');
