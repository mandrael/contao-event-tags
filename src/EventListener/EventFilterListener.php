<?php

namespace Mandrael\EventTagsBundle\EventListener;

use Contao\Database;
use Contao\StringUtil;

/**
 * Hook: getAllEvents — filtert die Events eines Eventliste-Moduls nach den
 * im Modul gewählten Tags (Logik OR/AND je Modul-Einstellung).
 */
class EventFilterListener
{
    public function __invoke(array $arrEvents, array $arrCalendars, int $intStart, int $intEnd, ?object $objModule = null): array
    {
        if (!$objModule || empty($objModule->filter_event_tags)) {
            return $arrEvents;
        }

        $filterTags = StringUtil::deserialize($objModule->filter_event_tags, true);
        if (empty($filterTags)) {
            return $arrEvents;
        }

        $filterTags = array_values(array_unique(array_map('strval', $filterTags)));
        $logic = 'AND' === strtoupper((string) ($objModule->filter_event_tags_logic ?? 'OR')) ? 'AND' : 'OR';

        $filteredEvents = [];

        foreach ($arrEvents as $dayDate => $times) {
            foreach ($times as $timeTimestamp => $eventsAtTime) {
                foreach ($eventsAtTime as $eventId => $eventData) {
                    // getAllEvents liefert die volle Event-Zeile; bei ungetaggten Events
                    // ist der Key vorhanden (NULL). array_key_exists statt isset vermeidet
                    // eine Nachlade-Query pro ungetaggtem Event (N+1). Der Fallback bleibt
                    // als Sicherheitsnetz, falls der Key wider Erwarten fehlt.
                    if (!array_key_exists('event_tags', $eventData)) {
                        $objEvent = Database::getInstance()
                            ->prepare('SELECT event_tags FROM tl_calendar_events WHERE id=?')
                            ->limit(1)
                            ->execute($eventData['id']);

                        if ($objEvent->numRows) {
                            $eventData['event_tags'] = $objEvent->event_tags;
                        }
                    }

                    $eventTags = StringUtil::deserialize($eventData['event_tags'] ?? null, true);
                    if (empty($eventTags)) {
                        continue;
                    }

                    $eventTags = array_map('strval', $eventTags);

                    if ($this->matchesTags($eventTags, $filterTags, $logic)) {
                        $filteredEvents[$dayDate][$timeTimestamp][$eventId] = $eventData;
                    }
                }
            }
        }

        return $this->pruneEmpty($filteredEvents);
    }

    /**
     * OR: Event muss mindestens einen Filter-Tag tragen.
     * AND: Event muss alle Filter-Tags tragen.
     *
     * Wiederverwendbar für das geplante URL-Filter-Feature (0.3.0).
     */
    private function matchesTags(array $eventTags, array $filterTags, string $logic): bool
    {
        $matches = count(array_intersect($filterTags, $eventTags));

        if ('AND' === $logic) {
            return $matches === count($filterTags);
        }

        return $matches > 0;
    }

    private function pruneEmpty(array $filteredEvents): array
    {
        foreach ($filteredEvents as $day => $times) {
            foreach ($times as $time => $evts) {
                if (empty($evts)) {
                    unset($filteredEvents[$day][$time]);
                }
            }

            if (empty($filteredEvents[$day])) {
                unset($filteredEvents[$day]);
            }
        }

        return $filteredEvents;
    }
}
