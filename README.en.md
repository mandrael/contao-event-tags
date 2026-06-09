**Language:** [Deutsch](README.md) · [English](README.en.md)

# mandrael/contao-event-tags

<img src="logo.svg" alt="Contao Event Tags" width="110" align="right">

This bundle extends Contao (4.13, 5.3 and 5.7 LTS) with a simple way to assign
centrally managed tags to events (`tl_calendar_events`) and to filter event
lists by these tags.

## Features

- New table **tl_event_tags** for tag management in the back end
  (back end module: Content → Event tags) – with a **usage counter**
  (number of events per tag) in the back end list.
- New field **event_tags** in **tl_calendar_events**:
  multi-select field with a search function (chosen).
  *The field is automatically positioned right after the author or title.*
- Extension of the **standard "Event list" module**:
  no new module type is required. The standard module gets a **Filter by tags**
  field plus a **Filter logic** option (OR/AND).
- **Filter logic:** shows events that have **any** (OR) or **all** (AND) of the
  tags selected in the module settings.

## Installation

1. Install the bundle via Composer: `composer require mandrael/contao-event-tags`.
2. Update the database (Contao Manager or `contao:migrate`).
3. Create your tags in the back end under **Content → Event tags**.
4. Assign the tags to your events in the calendar using the **Event tags** field.
5. Edit a frontend module of type **Event list** and select the desired tags
   plus the combination (OR/AND) in the **Filter by tags** field.

Compatible with Contao **4.13**, **5.3** and **5.7** LTS (PHP ≥ 8.1).
