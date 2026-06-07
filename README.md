**Sprache:** [Deutsch](README.md) · [English](README.en.md)

# mandrael/contao-event-tags

Dieses Bundle erweitert Contao (4.13, 5.3 und 5.7 LTS) um eine einfache Möglichkeit,
Events (`tl_calendar_events`) mit zentral verwalteten Tags zu versehen und
Eventlisten nach diesen Tags zu filtern.

## Funktionsumfang

- Neue Tabelle **tl_event_tags** zur Verwaltung von Tags im Backend
  (Backend-Modul: Inhalte → Event-Tags) – optional mit einer **Farbe**
  (in der Backend-Liste als Swatch sichtbar) und einem optionalen
  **Icon**-Feld sowie einem **Nutzungszähler** (Anzahl Events je Tag).
- Neues Feld **event_tags** in **tl_calendar_events**:
  Mehrfachauswahl über ein Select-Feld mit Suchfunktion (chosen).
  *Das Feld positioniert sich automatisch direkt nach dem Autor oder Titel.*
- Erweiterung des **Standard-Moduls „Eventliste"**:
  Es wird kein neuer Modultyp benötigt. Das Standard-Modul erhält ein Feld
  **Nach Tags filtern** sowie eine **Filter-Verknüpfung** (ODER/UND).
- **Filter-Logik:** Zeigt Events, die **mindestens einen** (ODER) bzw.
  **alle** (UND) der im Modul gewählten Tags besitzen.

## Installation

1. Bundle per Composer einbinden: `composer require mandrael/contao-event-tags`.
2. Datenbank aktualisieren (Contao-Manager oder `contao:migrate`).
3. Im Backend unter **Inhalte → Event-Tags** die gewünschten Tags anlegen.
4. In den Events (Kalender) im Feld **Event-Tags** die passenden Tags auswählen.
5. Ein Frontend-Modul vom Typ **Eventliste** bearbeiten und im Feld
   **Nach Tags filtern** die gewünschten Tags samt Verknüpfung (ODER/UND) wählen.

Kompatibel mit Contao **4.13**, **5.3** und **5.7** LTS (PHP ≥ 8.1).
