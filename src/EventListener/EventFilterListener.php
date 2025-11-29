<?php

namespace Mandrael\EventTagsBundle\EventListener;

use Contao\StringUtil;
use Contao\Database;

class EventFilterListener
{
    /**
     * Hook: getAllEvents
     */
    public function __invoke(array $arrEvents, array $arrCalendars, int $intStart, int $intEnd, ?object $objModule = null): array
    {
        // 1. Prüfen, ob wir filtern müssen
        if (!$objModule || empty($objModule->filter_event_tags)) {
            return $arrEvents;
        }

        // Filter-Tags vorbereiten
        $filterTags = StringUtil::deserialize($objModule->filter_event_tags, true);
        if (empty($filterTags)) {
            return $arrEvents;
        }

        // IDs zu Strings wandeln ("2" vs 2)
        $filterTags = array_map('strval', $filterTags);

        $filteredEvents = [];
        $db = Database::getInstance();

        // 2. SCHLEIFE 1: Tage durchgehen
        foreach ($arrEvents as $dayDate => $times) {
            
            // 3. SCHLEIFE 2: Uhrzeiten durchgehen (Hier war der Fehler vorher!)
            // Der Key $timeTimestamp ist die "falsche ID" 1272578400, die wir gesehen haben.
            foreach ($times as $timeTimestamp => $eventsAtTime) {
                
                // 4. SCHLEIFE 3: Die echten Events durchgehen (Hier ist ID 2249)
                foreach ($eventsAtTime as $eventId => $eventData) {
                    
                    // --- DATEN NACHLADEN (Sicherheitshalber) ---
                    if (!isset($eventData['event_tags'])) {
                        $realId = $eventData['id'];
                        // Jetzt holen wir die Tags zur echten ID (z.B. 2249)
                        $objEvent = $db->prepare("SELECT event_tags FROM tl_calendar_events WHERE id=?")
                                       ->limit(1)
                                       ->execute($realId);
                        
                        if ($objEvent->numRows) {
                            $eventData['event_tags'] = $objEvent->event_tags;
                        }
                    }
                    // --- ENDE NACHLADEN ---

                    $eventTags = StringUtil::deserialize($eventData['event_tags'] ?? null, true);

                    // Wenn Event keine Tags hat -> überspringen
                    if (!is_array($eventTags) || empty($eventTags)) {
                        continue;
                    }

                    $eventTags = array_map('strval', $eventTags);

                    // 5. Vergleich
                    if (count(array_intersect($filterTags, $eventTags)) > 0) {
                        // Wir bauen die Struktur exakt so nach, wie Contao sie erwartet:
                        // [Tag][Uhrzeit][EventID] = Daten
                        $filteredEvents[$dayDate][$timeTimestamp][$eventId] = $eventData;
                    }
                }
            }
        }

        // Wir entfernen leere Uhrzeiten und leere Tage, damit das Template nicht stolpert
        foreach ($filteredEvents as $day => $times) {
            // Leere Uhrzeiten entfernen
            foreach ($times as $time => $evts) {
                if (empty($evts)) {
                    unset($filteredEvents[$day][$time]);
                }
            }
            // Leere Tage entfernen
            if (empty($filteredEvents[$day])) {
                unset($filteredEvents[$day]);
            }
        }

        return $filteredEvents;
    }
}
