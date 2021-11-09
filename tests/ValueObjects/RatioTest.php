<?php

namespace BenSampo\Embed\Tests\ValueObjects;

use PHPUnit\Framework\TestCase;
use BenSampo\Embed\ValueObjects\Ratio;
use InvalidArgumentException;

class RatioTest extends TestCase
{
    public function test_it_accepts_a_valid_ratio()
    {
        $this->assertInstanceOf(Ratio::class, new Ratio('16:9'));
        $this->assertInstanceOf(Ratio::class, new Ratio('4:3'));
        $this->assertInstanceOf(Ratio::class, new Ratio('1:1'));
    }

    public function test_it_throws_an_exception_for_an_invalid_ratio()
    {
        $this->expectException(InvalidArgumentException::class);

        new Ratio('not-a-ratio');
    }

    public function test_it_extracts_the_height_and_width()
    {
        $ratio = new Ratio('16:9');
        $this->assertSame(16, $ratio->width);
        $this->assertSame(9, $ratio->height);
    }

    public function test_it_generates_a_percentage_representation()
    {
        $ratio = new Ratio('16:9');
        $this->assertSame(56.25, $ratio->asPercentage());

        $ratio = new Ratio('4:3');
        $this->assertSame(75.0, $ratio->asPercentage());

        $ratio = new Ratio('22:32');
        $this->assertSame(145.45, $ratio->asPercentage());
    }
}
