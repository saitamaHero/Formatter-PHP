<?php

declare(strict_types=1);

use App\Formatters\NumberFormatter;
use PHPUnit\Framework\TestCase;


class NumberFomatterTest extends TestCase
{
    protected $formatter = null;

    protected function setUp(): void
    {
        $this->formatter = new NumberFormatter();
    }

    public function testCorrectFormatWithoutParams(): void
    {

        $this->assertEquals('1,525', $this->formatter->format(1525, []));
    }

    public function testReturnNullIfNotNumberPassed(): void
    {
        $this->assertNull($this->formatter->format('hola', []));
    }
}
