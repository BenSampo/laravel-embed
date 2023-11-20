<?php

namespace BenSampo\Embed\Tests;

use BenSampo\Embed\ServiceContract;
use Illuminate\Contracts\View\View;
use BenSampo\Embed\ValueObjects\Url;
use BenSampo\Embed\ValueObjects\Ratio;
use BenSampo\Embed\Tests\Fixtures\Services\Dummy;
use BenSampo\Embed\Tests\Cases\ApplicationTestCase;
use BenSampo\Embed\Tests\Fixtures\Services\DummyTwo;

class ServiceBaseTest extends ApplicationTestCase
{
    protected ServiceContract $dummyService1;
    protected ServiceContract $dummyService2;

    public function setUp(): void
    {
        parent::setUp();

        $this->dummyService1 = (new Dummy(new Url('https://dummy.com')));
        $this->dummyService2 = (new DummyTwo(new Url('https://dummy-two.com')));
    }

    public function test_it_renders_a_view()
    {
        $this->assertInstanceOf(View::class, $this->dummyService1->view());
    }

    public function test_it_can_guess_view_name()
    {
        $this->assertSame('embed::services.dummy', $this->dummyService1->view()->name());
        $this->assertSame('embed::services.dummy-two', $this->dummyService2->view()->name());
    }

    public function test_it_can_pass_view_data()
    {
        $this->assertSame('bar', $this->dummyService1->view()->getData()['foo']);
    }

    public function test_it_can_set_the_aspect_ratio()
    {
        $ratio = new Ratio('4:3');
        $this->assertEquals($ratio, $this->dummyService1->setAspectRatio($ratio)->view()->getData()['aspectRatio']);
    }

    public function test_it_can_set_a_label()
    {
        $label = 'A different aria label';
        $this->assertEquals($label, $this->dummyService1->setLabel($label)->view()->getData()['label']);
    }
}
