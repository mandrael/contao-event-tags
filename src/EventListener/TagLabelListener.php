<?php

namespace Mandrael\EventTagsBundle\EventListener;

use Contao\StringUtil;
use Doctrine\DBAL\Connection;

/**
 * label_callback für tl_event_tags: rendert den escapeten Titel + den
 * Nutzungszähler (in wie vielen Events der Tag verwendet wird).
 *
 * Das Escaping des Titels deckt den Listenansicht-Ausgabekontext ab
 * (Stored-XSS-Schutz). Der Zähler wertet die serialisierten event_tags aus
 * (kein FIND_IN_SET möglich) und wird einmalig pro Request memoisiert.
 */
class TagLabelListener
{
    private Connection $connection;
    private ?array $usageCounts = null;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function __invoke(array $row, string $label, $dc = null, array $args = []): string
    {
        $title = StringUtil::specialchars(StringUtil::decodeEntities((string) ($row['title'] ?? '')));
        $count = $this->usageCounts()[(int) $row['id']] ?? 0;

        return $title . sprintf(' <span class="tl_gray">(%d)</span>', $count);
    }

    private function usageCounts(): array
    {
        if (null !== $this->usageCounts) {
            return $this->usageCounts;
        }

        $this->usageCounts = [];

        $rows = $this->connection->fetchFirstColumn(
            "SELECT event_tags FROM tl_calendar_events WHERE event_tags IS NOT NULL AND event_tags != ''"
        );

        foreach ($rows as $serialized) {
            foreach (StringUtil::deserialize($serialized, true) as $tagId) {
                $id = (int) $tagId;
                $this->usageCounts[$id] = ($this->usageCounts[$id] ?? 0) + 1;
            }
        }

        return $this->usageCounts;
    }
}
