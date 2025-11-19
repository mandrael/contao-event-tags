# mandrael/contao-event-tags

Dieses Bundle erweitert Contao (4.13 und 5.3) um eine einfache Möglichkeit,
Events (tl_calendar_events) mit zentral verwalteten Tags zu versehen und
Eventlisten nach diesen Tags zu filtern.

## Funktionsumfang

- Neue Tabelle **tl_event_tags** zur Verwaltung von Tags im Backend
  (Backend-Modul: Inhalte → Event-Tags)
- Neues Feld **event_tags** in **tl_calendar_events**:
  Mehrfachauswahl über ein Select-Feld mit Suchfunktion (chosen).
- Neues Feld **filter_event_tags** im Eventlisten-Modul:
  Mehrfachauswahl der Tags, nach denen gefiltert werden soll.
- Neues Frontend-Modul **Eventliste mit Tag-Filter** (`eventlist_tags`),
  das nur Events anzeigt, die mindestens einen der ausgewählten Tags besitzen.

## Installation

1. Bundle per Composer einbinden (lokal, über GitHub oder Packagist).
2. Datenbank aktualisieren (Contao Install-Tool oder Contao Manager).
3. Im Backend unter **Inhalte → Event-Tags** die gewünschten Tags anlegen.
4. In den Events im Feld **Tags** die passenden Tags auswählen.
5. Ein Eventlisten-Modul vom Typ **Eventliste mit Tag-Filter** anlegen
   und im Feld **Tags filtern** die gewünschten Filter-Tags wählen.

Getestet mit Contao **4.13** und **5.3**.
