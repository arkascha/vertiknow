<?php
declare(strict_types=1);

include __DIR__ . '/../../logic/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

/**
 * @covers SimpleDom
 */
final class SimpleDomTest extends TestCase
{
    public function testModuleSimpleDom()
    {
        $this->assertTrue(
            class_exists('\simple_html_dom')
        );
    }

    public function testClassCanBeInstantiated()
    {
        $dom = new \simple_html_dom;
        $this->assertInstanceOf('\simple_html_dom', $dom);
    }
}
