<?php

namespace BenSampo\Embed\Tests;

use Illuminate\Contracts\View\View;
use BenSampo\Embed\ValueObjects\Ratio;
use BenSampo\Embed\Tests\Fixtures\Services\Dummy;
use BenSampo\Embed\Tests\Cases\ApplicationTestCase;
use BenSampo\Embed\Tests\Fixtures\Services\DummyTwo;

class ServiceBaseTest extends ApplicationTestCase
{
    public function test_it_renders_a_view()
    {
        $this->assertInstanceOf(View::class, (new Dummy('https://dummy.com'))->view());
    }

    public function test_it_can_guess_view_name()
    {
        $this->assertEquals('embed::services.dummy', (new Dummy('https://dummy.com'))->view()->name());
        $this->assertEquals('embed::services.dummy-two', (new DummyTwo('https://dummy-two.com'))->view()->name());
    }

    public function test_it_can_pass_view_data()
    {
        $this->assertEquals('bar', (new Dummy('https://dummy.com'))->view()->getData()['foo']);
    }

    public function test_it_can_set_the_aspect_ratio()
    {
        $ratio = new Ratio('4:3');
        $this->assertEquals($ratio, (new Dummy('https://dummy.com'))->setAspectRatio($ratio)->view()->getData()['aspectRatio']);
    }
}
