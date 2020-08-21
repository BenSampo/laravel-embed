<?php

namespace BenSampo\Embed\Tests\ViewComponents;

use BenSampo\Embed\ServiceFactory;
use BenSampo\Embed\Tests\Cases\ApplicationTestCase;
use BenSampo\Embed\ViewComponents\EmbedViewComponent;

class EmbedViewComponentTest extends ApplicationTestCase
{
    public function test_it_can_render_a_view_for_a_service()
    {
        ServiceFactory::fake();

        $this->assertEquals('Dummy service', (new EmbedViewComponent('https://dummy.com'))->render());
    }

    public function test_it_renders_a_fallback_view_if_no_appropriate_service_is_found()
    {
        $this->assertStringContainsString(
            'No embed service could be found for: https://non-existing-service.com', 
            (new EmbedViewComponent('https://non-existing-service.com'))->render()
        );
    }

    public function test_it_can_cache_a_rendered_view()
    {
        $this->markTestIncomplete();
    }
}
