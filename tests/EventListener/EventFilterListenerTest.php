<?php

namespace Mandrael\EventTagsBundle\Tests\EventListener;

use Mandrael\EventTagsBundle\EventListener\EventFilterListener;
use PHPUnit\Framework\TestCase;

class EventFilterListenerTest extends TestCase
{
    private function callMatchesTags(array $eventTags, array $filterTags, string $logic): bool
    {
        $method = new \ReflectionMethod(EventFilterListener::class, 'matchesTags');

        return $method->invoke(new EventFilterListener(), $eventTags, $filterTags, $logic);
    }

    public function testOrMatchesAtLeastOne(): void
    {
        $this->assertTrue($this->callMatchesTags(['1', '2'], ['2', '3'], 'OR'));
        $this->assertFalse($this->callMatchesTags(['1', '2'], ['3', '4'], 'OR'));
    }

    public function testAndRequiresAllFilterTags(): void
    {
        $this->assertTrue($this->callMatchesTags(['1', '2', '3'], ['1', '2'], 'AND'));
        $this->assertFalse($this->callMatchesTags(['1', '2'], ['1', '2', '3'], 'AND'));
    }

    public function testSingleTag(): void
    {
        $this->assertTrue($this->callMatchesTags(['5'], ['5'], 'OR'));
        $this->assertTrue($this->callMatchesTags(['5'], ['5'], 'AND'));
    }
}
