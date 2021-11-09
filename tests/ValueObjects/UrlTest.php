<?php

namespace BenSampo\Embed\Tests\ValueObjects;

use PHPUnit\Framework\TestCase;
use BenSampo\Embed\ValueObjects\Url;
use InvalidArgumentException;

class UrlTest extends TestCase
{
    public function test_it_accepts_a_valid_url()
    {
        $this->assertInstanceOf(Url::class, new Url('https://sampo.co.uk'));
        $this->assertInstanceOf(Url::class, new Url('http://sampo.co.uk'));
    }

    public function test_it_throws_an_exception_for_an_invalid_url()
    {
        $this->expectException(InvalidArgumentException::class);

        new Url('not-valid....com');
    }

    public function test_it_can_be_cast_to_a_string()
    {
        $url = new Url('https://sampo.co.uk');

        $this->assertSame('https://sampo.co.uk', (string) $url);
    }

    public function test_it_attempts_to_prepend_https_if_missing()
    {
        $url = new Url('sampo.co.uk');

        $this->assertInstanceOf(Url::class, $url);
        $this->assertSame('https://sampo.co.uk', (string) $url);
    }
}
