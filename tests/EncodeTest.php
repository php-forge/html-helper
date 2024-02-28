<?php

declare(strict_types=1);

namespace PHPForge\Html\Tests\Helper;

use PHPForge\{Html\Helper\Encode, Support\Assert};
use PHPUnit\Framework\TestCase;

final class EncodeTest extends TestCase
{
    public function testInitializate(): void
    {
        Encode::initialize(['form', 'style'], ['button', 'form', 'input', 'select', 'svg', 'textarea']);

        $this->assertSame(
            ['form', 'style'],
            Assert::inaccessibleProperty(new Encode(), 'removeEvilAttributes')
        );
        $this->assertSame(
            ['button', 'form', 'input', 'select', 'svg', 'textarea'],
            Assert::inaccessibleProperty(new Encode(), 'removeEvilHtmlTags')
        );
    }

    /**
     * @dataProvider PHPForge\Html\Helper\Tests\Provider\EncodeProvider::encode
     *
     * @param string $value Value to encode.
     * @param string $expected Expected result.
     * @param bool $doubleEncode Whether to encode HTML entities in `$value`.
     */
    public function testContent(string $value, string $expected, bool $doubleEncode): void
    {
        $this->assertSame($expected, Encode::content($value));
        $this->assertSame($expected, Encode::content($value, $doubleEncode));
    }

    public function testSantizeXSS(): void
    {
        $this->assertSame(
            '<a >click</a>',
            Encode::sanitizeXSS('<a href=&#x2000;javascript:alert(1)>click</a>')
        );
        $this->assertSame(
            '<button><img src="http://fakeurl.com/fake.jpg" /></button>',
            Encode::sanitizeXSS('<button><img src="http://fakeurl.com/fake.jpg" onerror="alert(\'XSS\')"/></button>')
        );
        $this->assertSame(
            '<form><input type="text" value="test" /></form>',
            Encode::sanitizeXSS('<form><input type="text" value="test" onfocus="alert(\'XSS\')"/></form>')
        );
        $this->assertSame(
            '<img >',
            Encode::sanitizeXSS('<img src=&#x6A&#x61&#x76&#x61&#x73&#x63&#x72&#x69&#x70&#x74&#x3A&#x61&#x6C&#x65&#x72&#x74&#x28&#x27&#x58&#x53&#x53&#x27&#x29>')
        );
        $this->assertSame(
            '<input type="text" value="test"  />',
            Encode::sanitizeXSS('<input type="text" value="test" onfocus="alert(\'XSS\')" />')
        );
        $this->assertSame(
            '<select><option value="test">test</option></select>',
            Encode::sanitizeXSS('<select><option value="test">test</option></select>')
        );
        $this->assertSame(
            '<svg></svg>',
            Encode::sanitizeXSS('<svg><script>alert("XSS")</script></svg>')
        );
        $this->assertSame(
            '<textarea></textarea>',
            Encode::sanitizeXSS('<textarea><script>alert("XSS")</script></textarea>')
        );
        $this->assertSame(
            '<div><input type="text" value="test" style="padding-left:20px" oinvalid=""  /></div>',
            Encode::sanitizeXSS(
                '<div>',
                '<input type="text" value="test" style="padding-left:20px" oinvalid="" onfocus="alert(\'XSS\')" />',
                '</div>'
            )
        );
    }

    /**
     * @dataProvider PHPForge\Html\Helper\Tests\Provider\EncodeProvider::encodeValue
     *
     * @param string $value Value to encode.
     * @param string $expected Expected result.
     * @param bool $doubleEncode Whether to encode HTML entities in `$value`.
     */
    public function testValue(string $value, string $expected, bool $doubleEncode): void
    {
        $this->assertSame($expected, Encode::value($value));
        $this->assertSame($expected, Encode::value($value, $doubleEncode));
    }
}