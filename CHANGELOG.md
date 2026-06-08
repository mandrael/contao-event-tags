# Changelog

Alle nennenswerten Änderungen an diesem Projekt werden hier dokumentiert.
Das Format orientiert sich an [Keep a Changelog](https://keepachangelog.com/de/1.1.0/),
die Versionierung folgt [Semantic Versioning](https://semver.org/lang/de/).

## [0.2.0] – 2026-06-08

### Sicherheit
- Tag-Titel werden in den Backend-Select-Optionen und in der Listenansicht
  escaped (Schutz vor Stored-XSS über das nicht escapende SelectMenu-Widget).

### Hinzugefügt
- **Nutzungszähler** je Tag in der Backend-Liste (Anzahl verwendender Events).
- **Filter-Verknüpfung** (ODER/UND) pro Eventliste-Modul.
- Englische Sprachdateien; alle Backend-Labels in Sprachdateien externalisiert
  (Deutsch + Englisch).
- Harte Composer-Abhängigkeit `contao/calendar-bundle`.
- Zweisprachige README (`README.md` / `README.en.md`).

### Geändert
- Expliziter Rückgabetyp `array` an `Plugin::getBundles()` (passend zum
  `@return`-Hinweis des Interfaces; Code-Härte und Static-Analysis-Klarheit).

### Behoben
- N+1-Datenbankabfrage im `getAllEvents`-Filter bei ungetaggten Events.

### Kompatibilität
- Contao 4.13, 5.3 und 5.7 LTS (PHP ≥ 8.1).
- Nur additive DB-Spalte (`tl_module.filter_event_tags_logic`) – Downgrade auf
  0.1.1 problemlos.

## [0.1.1] – 2025-11-29

### Behoben
- Datacontainer von `tl_event_tags` auf `Contao\DC_Table::class` umgestellt
  (zuvor der String `'Table'`) – Voraussetzung für Contao 5.3.
- Hartkodiertes `version`-Feld aus `composer.json` entfernt (die Version wird
  vom Git-Tag abgeleitet).

### Hinzugefügt
- Deutsches Label `title_legend` („Event-Tag") für `tl_event_tags`.

### Kompatibilität
- Getestet mit Contao 5.3.

## [0.1.0] – 2025-11-29

### Hinzugefügt
- Erstveröffentlichung.
- Zentrale **Tag-Verwaltung** (`tl_event_tags`) mit Backend-Modul
  (Inhalte → Event-Tags).
- **Tag-Zuweisung an Events** über das Mehrfachauswahl-Feld `event_tags` in
  `tl_calendar_events`.
- **Eventlisten-Filterung nach Tags** über den `getAllEvents`-Hook
  (`EventFilterListener`); das Eventliste-Modul erhält das Feld
  „Nach Tags filtern" (`filter_event_tags`). Filter-Logik: ODER.
- Deutsche Sprachdateien.

### Kompatibilität
- Contao 4.13 und 5.x.
