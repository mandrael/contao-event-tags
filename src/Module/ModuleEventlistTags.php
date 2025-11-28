<?php

namespace Mandrael\EventTagsBundle\Module;

use Contao\ModuleEventlist;
use Contao\StringUtil;

class ModuleEventlistTags extends ModuleEventlist
{
    /**
     * Überschreibt die Methode zum Abrufen der Events.
     * So filtern wir die Rohdaten, bevor sie gerendert werden.
     * * @param array $strCalendars
     * @param int $intStart
     * @param int $intEnd
     * * @return array
     */
    protected function getAllEvents($strCalendars, $intStart, $intEnd)
    {
        // Erst alle Events vom Parent holen (Standard-Logik)
        $allEvents = parent::getAllEvents($strCalendars, $intStart, $intEnd);

        // Filter-Tags aus dem Modul holen
        $filterTags = StringUtil::deserialize($this->filter_event_tags, true);

        // Wenn keine Tags gewählt sind, geben wir einfach das Original-Ergebnis zurück
        if (!is_array($filterTags) || empty($filterTags)) {
            return $allEvents;
        }

        $filteredEvents = [];

        // Die Struktur von $allEvents ist: $arrEvents[TagesTimestamp][EventID] = array(EventDaten)
        if (is_array($allEvents)) {
            foreach ($allEvents as $dayTimestamp => $dayEvents) {
                foreach ($dayEvents as $eventId => $eventData) {
                    
                    // Tags des einzelnen Events prüfen
                    $eventTags = StringUtil::deserialize($eventData['event_tags'] ?? null, true);

                    if (!is_array($eventTags) || empty($eventTags)) {
                        continue;
                    }

                    // OR-Logik: Mindestens ein Tag muss übereinstimmen
                    // array_intersect prüft auf Übereinstimmungen
                    if (count(array_intersect($filterTags, $eventTags)) > 0) {
                        // Event behalten
                        $filteredEvents[$dayTimestamp][$eventId] = $eventData;
                    }
                }
            }
        }

        // Leere Tage entfernen (optional, aber sauberer)
        return array_filter($filteredEvents);
    }
}
