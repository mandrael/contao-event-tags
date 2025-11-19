<?php

namespace Mandrael\EventTagsBundle\Module;

use Contao\ModuleEventlist;

class ModuleEventlistTags extends ModuleEventlist
{
    /**
     * {@inheritdoc}
     */
    protected function compile(): void
    {
        parent::compile();

        $filterTags = deserialize($this->filter_event_tags, true);

        if (!is_array($filterTags) || empty($filterTags)) {
            return;
        }

        $filteredEvents = [];

        // $this->Template->events ist in der Regel nach Tagen gruppiert
        foreach ($this->Template->events as $dayKey => $events) {
            $dayFiltered = [];

            foreach ($events as $event) {
                $eventTags = deserialize($event['event_tags'] ?? null, true);

                if (!is_array($eventTags) || empty($eventTags)) {
                    continue;
                }

                // OR-Logik: mind. ein Tag muss übereinstimmen
                if (count(array_intersect($filterTags, $eventTags)) > 0) {
                    $dayFiltered[] = $event;
                }
            }

            if (!empty($dayFiltered)) {
                $filteredEvents[$dayKey] = $dayFiltered;
            }
        }

        $this->Template->events = $filteredEvents;
    }
}
