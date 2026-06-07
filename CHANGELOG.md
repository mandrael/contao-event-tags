# Changelog

Alle nennenswerten Änderungen an diesem Projekt werden hier dokumentiert.
Das Format orientiert sich an [Keep a Changelog](https://keepachangelog.com/de/1.1.0/),
die Versionierung folgt [Semantic Versioning](https://semver.org/lang/de/).

## [0.2.0] – 2026-06-06

### Sicherheit
- Tag-Titel werden in den Backend-Select-Optionen und in der Listenansicht
  escaped (Schutz vor Stored-XSS über das nicht escapende SelectMenu-Widget).

### Hinzugefügt
- Optionales **Farb**-Feld je Tag, in der Backend-Liste als Swatch sichtbar.
- Optionales **Icon**-Feld je Tag (gespeichert; gerenderte Anzeige für ein
  späteres Release vorgesehen).
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
- Nur additive DB-Spalten (`tl_event_tags.color`, `tl_event_tags.icon`,
  `tl_module.filter_event_tags_logic`) – Downgrade auf 0.1.1 problemlos.

## [0.1.1] – 2025-11-29

## [0.1.0]
