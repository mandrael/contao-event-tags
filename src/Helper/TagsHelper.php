<?php

namespace Mandrael\EventTagsBundle\Helper;

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
     */
    public function getTags(): array
    {
        $options = [];

        $records = $this->connection->fetchAllAssociative(
            'SELECT id, title FROM tl_event_tags ORDER BY title'
        );

        foreach ($records as $row) {
            $options[(int) $row['id']] = $row['title'];
        }

        return $options;
    }
}
