<?php

namespace BenSampo\Embed\Tests\Validators;

use BenSampo\Embed\Tests\Cases\ApplicationTestCase;
use Validator;


class ValidatorTest extends ApplicationTestCase
{
    public function test_it_passes_a_valid_url_for_any_service()
    {
    	$valid_urls = [
		    'https://www.dailymotion.com/video/xg4y8d',
		    'https://dai.ly/xg4y8d',
		    'https://miro.com/miroverse/category/workshops/remote-ux-workshops',
		    'http://www.slideshare.net/haraldf/business-quotes-for-2011',
		    'https://vimeo.com/148751763',
		    'https://youtu.be/dQw4w9WgXcQ',
		    'https://www.youtube.com/embed/dQw4w9WgXcQ',
	    ];

    	foreach ($valid_urls as $valid_url) {
		    $validator = Validator::make(
			    ['url' =>  $valid_url],
			    ['url' => 'embed_service']
		    );
    	    $this->assertTrue($validator->passes());
        }
    }

    public function test_it_passes_for_service()
    {
    	$valid_urls = [
		    'https://www.youtube.com/embed/dQw4w9WgXcQ',
	    ];

    	foreach ($valid_urls as $valid_url) {
		    $validator = Validator::make(
			    ['url' =>  $valid_url],
			    ['url' => 'embed_service:you-tube']
		    );
    	    $this->assertTrue($validator->passes());
        }
    }

    public function test_it_passes_for_service_in_list()
    {
    	$valid_urls = [
		    'https://www.youtube.com/embed/dQw4w9WgXcQ',
	    ];

    	foreach ($valid_urls as $valid_url) {
		    $validator = Validator::make(
			    ['url' =>  $valid_url],
			    ['url' => 'embed_service:you-tube,vimeo']
		    );
    	    $this->assertTrue($validator->passes());
        }
    }

    public function test_it_fails_an_invalid_url()
    {
    	$invalid_urls = [
		    'xyz',
	    ];

    	foreach ($invalid_urls as $invalid_url) {
		    $validator = Validator::make(
			    ['url' =>  $invalid_url],
			    ['url' => 'embed_service']
		    );
    	    $this->assertTrue($validator->fails());
        }
    }

    public function test_it_fails_an_unsupported_service()
    {
    	$invalid_urls = [
		    'https://www.real.com/video/xg4y8d',
	    ];

    	foreach ($invalid_urls as $invalid_url) {
		    $validator = Validator::make(
			    ['url' =>  $invalid_url],
			    ['url' => 'embed_service']
		    );
    	    $this->assertTrue($validator->fails());
        }
    }

    public function test_it_fails_for_service_not_allowed()
    {
    	$invalid_urls = [
		    'https://www.youtube.com/embed/dQw4w9WgXcQ',
	    ];

    	foreach ($invalid_urls as $invalid_url) {
		    $validator = Validator::make(
			    ['url' =>  $invalid_url],
			    ['url' => 'embed_service:vimeo']
		    );
    	    $this->assertTrue($validator->fails());
        }
    }

    public function test_it_fails_for_service_not_allowed_in_list()
    {
    	$invalid_urls = [
		    'https://www.youtube.com/embed/dQw4w9WgXcQ',
	    ];

    	foreach ($invalid_urls as $invalid_url) {
		    $validator = Validator::make(
			    ['url' =>  $invalid_url],
			    ['url' => 'embed_service:miro,vimeo']
		    );
    	    $this->assertTrue($validator->fails());
        }
    }

    public function test_it_replaces_supported_services_in_message_with_no_services_specified()
    {
	    $url = 'https://www.real.com/video/xg4y8d';

	    $validator = Validator::make(
		    ['url' =>  $url],
		    ['url' => 'embed_service'],
		    ['embed_service' => 'The :attribute must be a URL from :services']
	    );
	    $message  = $validator->messages()->get('url')[0];
	    $expected = 'The url must be a URL from a supported service';
	    $this->assertEquals($expected, $message);
    }

    public function test_it_replaces_supported_service_in_message()
    {
	    $url = 'https://www.real.com/video/xg4y8d';

	    $validator = Validator::make(
		    ['url' =>  $url],
		    ['url' => 'embed_service:you-tube'],
		    ['embed_service' => 'The :attribute must be a URL from :services']
	    );
	    $message  = $validator->messages()->get('url')[0];
	    $expected = 'The url must be a URL from YouTube';
	    $this->assertEquals($expected, $message);
    }

    public function test_it_replaces_supported_services_list_in_message()
    {
	    $url = 'https://www.real.com/video/xg4y8d';

	    $validator = Validator::make(
		    ['url' =>  $url],
		    ['url' => 'embed_service:you-tube,vimeo,miro'],
		    ['embed_service' => 'The :attribute must be a URL from :services']
	    );
	    $message  = $validator->messages()->get('url')[0];
	    $expected = 'The url must be a URL from YouTube, Vimeo or Miro';
	    $this->assertEquals($expected, $message);
    }

}
