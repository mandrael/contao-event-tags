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
        $db = Database::getInstance();
        $obj = $db->execute("SELECT id, title FROM tl_event_tags ORDER BY title");

        while ($obj->next()) {
            $options[(int) $obj->id] = $obj->title;
        }

        return $options;
    }
}
