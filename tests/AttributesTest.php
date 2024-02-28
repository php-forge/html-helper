<?php

declare(strict_types=1);

namespace PHPForge\Html\Tests\Helper;

use PHPForge\Html\Helper\Attributes;

final class AttributesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider PHPForge\Html\Helper\Tests\Provider\AttributesProvider::dataRenderTagAttributes
     */
    public function testRenderTagAttributes(string $expected, array $attributes): void
    {
        $this->assertSame($expected, Attributes::render($attributes));
    }
}
