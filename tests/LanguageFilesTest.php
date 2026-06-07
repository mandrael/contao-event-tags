<?php

namespace Mandrael\EventTagsBundle\Tests;

use PHPUnit\Framework\TestCase;

class LanguageFilesTest extends TestCase
{
    private const FILES = ['default.php', 'tl_event_tags.php', 'tl_calendar_events.php', 'tl_module.php', 'modules.php'];

    private function load(string $lang): array
    {
        $GLOBALS['TL_LANG'] = [];
        $base = __DIR__ . '/../src/Resources/contao/languages/' . $lang . '/';

        foreach (self::FILES as $file) {
            include $base . $file;
        }

        return $this->flatten($GLOBALS['TL_LANG']);
    }

    public function testDeAndEnHaveIdenticalKeySets(): void
    {
        $this->assertEqualsCanonicalizing(
            array_keys($this->load('de')),
            array_keys($this->load('en')),
            'DE und EN Sprachdateien haben unterschiedliche Schlüssel.'
        );
    }

    public function testRequiredKeysPresent(): void
    {
        $de = $this->load('de');

        $required = [
            'MSC.eventTagsDeleteConfirm',
            'tl_event_tags.title_legend',
            'tl_event_tags.title.0',
            'tl_event_tags.delete.0',
            'tl_calendar_events.event_tags.0',
            'tl_module.filter_event_tags.0',
            'tl_module.filter_event_tags_logic.0',
            'tl_module.filter_event_tags_logic_options.OR',
            'tl_module.filter_event_tags_logic_options.AND',
            'MOD.event_tags.0',
        ];

        foreach ($required as $key) {
            $this->assertArrayHasKey($key, $de, "Fehlender DE-Schlüssel: $key");
        }
    }

    private function flatten(array $arr, string $prefix = ''): array
    {
        $out = [];

        foreach ($arr as $k => $v) {
            $key = '' === $prefix ? (string) $k : $prefix . '.' . $k;

            if (is_array($v)) {
                $out += $this->flatten($v, $key);
            } else {
                $out[$key] = $v;
            }
        }

        return $out;
    }
}
