<?php

namespace Tests\App\Controllers;

use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
	public function test_homepage_route_loads(): void
	{
        /**
         * We want to check, if the GET request on the '/' url (which is the url for the 
         * Home page) will load the Home page. So we simulate this request, by placing the GET and
         * '/' into the $_SERVER superglobal. That is as if browser hat sent this request.
         */
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/';

		ob_start();

        // This loads the application's entry point (front controller).
        // index.php reads $_SERVER values, runs the router,
        // calls the correct controller, and echoes the page content.
		require_once __DIR__ . '/../../../public/index.php';
        
		$output = ob_get_clean();

		$this->assertStringContainsString('Home page', $output);
	}
}