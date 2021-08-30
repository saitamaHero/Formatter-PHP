<?php

declare(strict_types=1);

use App\Formatters\TextFormatter;
use PHPUnit\Framework\TestCase;

class TextFormatterTest extends TestCase
{
    protected $formatter = null;

    protected function setUp(): void
    {
        $this->formatter = new TextFormatter();
    }

    public function testValueIsTheSameWithoutParams()
    {
        $value = 'Hello World!';

        $this->assertEquals(
            'Hello World!',
            $this->formatter->format($value, [])
        );
    }

    public function testValueIsTransformnToDesireValue()
    {
        $value = 'Hello World!';

        $this->assertEquals(
            'HELLO WORLD!',
            $this->formatter->format($value, ['transform' => 'upper'])
        );
    }
}
