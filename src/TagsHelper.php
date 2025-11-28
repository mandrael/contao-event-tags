<?php

namespace Mandrael\EventTagsBundle;

use Contao\Database;

class TagsHelper
{
    /**
     * Liefert alle Tags aus tl_event_tags als Options-Array.
     *
     * @return array<int,string>
     */
    public static function getTags(): array
    {
        $options = [];
        // Hinweis: In Contao 5 ist Database::getInstance() Legacy. 
        // Für simple Callbacks ist es aber weiterhin der pragmatischste Weg.
        $db = Database::getInstance();
        $obj = $db->execute("SELECT id, title FROM tl_event_tags ORDER BY title");

        while ($obj->next()) {
            $options[(int) $obj->id] = $obj->title;
        }

        return $options;
    }
}
