<?php

namespace Mandrael\EventTagsBundle\Module;

use Contao\ModuleEventlist;
use Contao\StringUtil;

class ModuleEventlistTags extends ModuleEventlist
{
    /**
     * Holt alle Events und filtert sie nach den im Modul gesetzten Tags.
     *
     * @param array      $arrCalendars
     * @param int        $intStart
     * @param int        $intEnd
     * @param bool|int   $blnFeatured  Optionales Featured-Flag (Signatur wie im Core)
     *
     * @return array
     */
    protected function getAllEvents($arrCalendars, $intStart, $intEnd, $blnFeatured = null)
    {
        // Erst alle Events mit der Core-Logik holen
        $allEvents = parent::getAllEvents($arrCalendars, $intStart, $intEnd, $blnFeatured);

        // Tags aus dem Modul (DCA: tl_module.filter_event_tags)
        $filterTags = StringUtil::deserialize($this->filter_event_tags, true);

        // Wenn keine Filter gesetzt sind → nichts filtern
        if (empty($filterTags)) {
            return $allEvents;
        }

        $filtered = [];

        foreach ($allEvents as $dayTimestamp => $eventsOfDay) {
            foreach ($eventsOfDay as $eventId => $eventData) {
                // event_tags kommt aus tl_calendar_events (BLOB, serialisiert)
                $eventTags = StringUtil::deserialize($eventData['event_tags'] ?? null, true);

                if (empty($eventTags)) {
                    continue;
                }

                // OR-Logik: Mindestens ein Tag muss übereinstimmen
                if (!empty(array_intersect($filterTags, $eventTags))) {
                    $filtered[$dayTimestamp][$eventId] = $eventData;
                }
            }

            // Leere Tage entfernen
            if (empty($filtered[$dayTimestamp] ?? [])) {
                unset($filtered[$dayTimestamp]);
            }
        }

        return $filtered;
    }
}
