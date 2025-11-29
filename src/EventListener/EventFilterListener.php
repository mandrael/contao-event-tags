<?php

namespace Mandrael\EventTagsBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\StringUtil;

/**
 * @Hook("getAllEvents")
 */
class EventFilterListener
{
    /**
     * Filtert die Events basierend auf den Moduleinstellungen
     */
    public function __invoke(array $arrEvents, array $arrCalendars, int $intStart, int $intEnd, ?object $objModule = null): array
    {
        // Abbruch, wenn kein Modul da ist oder keine Tags gewählt wurden
        if (!$objModule || empty($objModule->filter_event_tags)) {
            return $arrEvents;
        }

        $filterTags = StringUtil::deserialize($objModule->filter_event_tags, true);
        if (empty($filterTags)) {
            return $arrEvents;
        }

        $filteredEvents = [];

        // Contao liefert Events gruppiert nach Tagen: $arrEvents[Timestamp][ID] = EventData
        foreach ($arrEvents as $dayTimestamp => $dayEvents) {
            foreach ($dayEvents as $eventId => $eventData) {
                
                $eventTags = StringUtil::deserialize($eventData['event_tags'] ?? null, true);

                // Wenn Event keine Tags hat -> rausfiltern
                if (!is_array($eventTags) || empty($eventTags)) {
                    continue;
                }

                // Prüfung: Hat das Event einen der gesuchten Tags?
                if (count(array_intersect($filterTags, $eventTags)) > 0) {
                    $filteredEvents[$dayTimestamp][$eventId] = $eventData;
                }
            }
        }

        // Leere Tage entfernen
        return array_filter($filteredEvents);
    }
}
