<?php

namespace Mandrael\EventTagsBundle\Helper;

use Contao\StringUtil;
use Doctrine\DBAL\Connection;

class TagsHelper
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Liefert die Tag-Optionen für Select-Felder (id => title).
     *
     * Der Titel wird escaped, weil Contaos SelectMenu-Widget Option-Labels
     * ungefiltert ausgibt (Stored-XSS-Schutz). decodeEntities normalisiert
     * zuerst, damit bereits kodierte Titel nicht doppelt escaped werden.
     */
    public function getTags(): array
    {
        $options = [];

        $records = $this->connection->fetchAllAssociative(
            'SELECT id, title FROM tl_event_tags ORDER BY title'
        );

        foreach ($records as $row) {
            $options[(int) $row['id']] = StringUtil::specialchars(
                StringUtil::decodeEntities((string) $row['title'])
            );
        }

        return $options;
    }
}
