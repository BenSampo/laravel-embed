<?php

namespace BenSampo\Embed\Tests;

use Illuminate\Contracts\View\View;
use BenSampo\Embed\Tests\Fixtures\Services\Dummy;
use BenSampo\Embed\Tests\Cases\ApplicationTestCase;
use BenSampo\Embed\Tests\Fixtures\Services\DummyTwo;

class ServiceBaseTest extends ApplicationTestCase
{
    public function test_it_renders_a_view()
    {
        $this->assertInstanceOf(View::class, (new Dummy('https://dummy.com'))->render());
    }

    public function test_it_can_guess_view_name()
    {
        $this->assertEquals('embed::services.dummy', (new Dummy('https://dummy.com'))->render()->name());
        $this->assertEquals('embed::services.dummy-two', (new DummyTwo('https://dummy-two.com'))->render()->name());
    }

    public function test_it_can_pass_view_data()
    {
        $this->assertEquals([
            'foo' => 'bar',
        ], (new Dummy('https://dummy.com'))->render()->getData());
    }
}
