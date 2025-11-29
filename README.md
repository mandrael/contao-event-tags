# mandrael/contao-event-tags

Dieses Bundle erweitert Contao (4.13 und 5.3) um eine einfache Möglichkeit,
Events (tl_calendar_events) mit zentral verwalteten Tags zu versehen und
Eventlisten nach diesen Tags zu filtern.

## Funktionsumfang

- Neue Tabelle **tl_event_tags** zur Verwaltung von Tags im Backend
  (Backend-Modul: Inhalte → Event-Tags).
- Neues Feld **event_tags** in **tl_calendar_events**:
  Mehrfachauswahl über ein Select-Feld mit Suchfunktion (chosen).
  *Das Feld positioniert sich automatisch direkt nach dem Autor oder Titel.*
- Erweiterung des **Standard-Moduls "Eventliste"**:
  Es wird kein neuer Modultyp benötigt! Das Standard-Modul erhält ein neues Feld
  **Nach Tags filtern**.
- **Filter-Logik:** Zeigt nur Events an, die **mindestens einen** der im Modul
  ausgewählten Tags besitzen (ODER-Verknüpfung).

## Installation

1. Bundle per Composer einbinden (lokal, über GitHub oder Packagist).
2. Datenbank aktualisieren (Contao Install-Tool oder Contao Manager).
3. Im Backend unter **Inhalte → Event-Tags** die gewünschten Tags anlegen.
4. In den Events (Kalender) im neuen Feld **Event-Tags** die passenden Tags auswählen.
5. Ein Frontend-Modul vom Typ **Eventliste** bearbeiten (oder neu anlegen)
   und im Feld **Nach Tags filtern** die gewünschten Tags wählen.

Getestet mit Contao **4.13** und demnächst mit **5.3**.

---

# mandrael/contao-event-tags

This bundle extends Contao (4.13 and 5.3) with a simple way to assign centrally
managed tags to events (tl_calendar_events) and filter event lists by these tags.

## Features

- New table **tl_event_tags** for tag management in the backend
  (Backend module: Content → Event-Tags).
- New field **event_tags** in **tl_calendar_events**:
  Multi-select field with search function (chosen).
  *The field is automatically positioned right after the author or title.*
- Extension of the **Standard "Event list" module**:
  No new module type is required! The standard module gets a new field
  **Filter by tags**.
- **Filter Logic:** Displays only events that match **at least one** of the
  tags selected in the module settings (OR logic).

## Installation

1. Install the bundle via Composer (locally, via GitHub, or Packagist).
2. Update the database (Contao Install Tool or Contao Manager).
3. Create your desired tags in the backend under **Content → Event-Tags**.
4. Assign the tags to your events in the calendar using the new **Event-Tags** field.
5. Edit (or create) a frontend module of type **Event list** and select the
   desired tags in the **Filter by tags** field.

Tested with Contao **4.13** and soon with **5.3**.
