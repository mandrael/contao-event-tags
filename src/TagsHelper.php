<?php

namespace Mandrael\EventTagsBundle;

use Doctrine\DBAL\Connection;

class TagsHelper
{
    private Connection $connection;

    // Dependency Injection: Die Verbindung kommt automatisch rein
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Liefert alle Tags
     * WICHTIG: Das "static" muss hier weg!
     */
    public function getTags(): array
    {
        $options = [];
        
        // Modernes Doctrine SQL
        $records = $this->connection->fetchAllAssociative("SELECT id, title FROM tl_event_tags ORDER BY title");

        foreach ($records as $row) {
            $options[(int) $row['id']] = $row['title'];
        }

        return $options;
    }
}
