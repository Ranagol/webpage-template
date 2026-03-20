<?php

namespace Tests\App\Controllers;

use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
	public function test_homepage_route_loads(): void
	{
		$_ENV['DB_HOST'] = $_ENV['DB_HOST'] ?? 'localhost';
		$_ENV['DB_DATABASE'] = $_ENV['DB_DATABASE'] ?? 'test';
		$_ENV['DB_USERNAME'] = $_ENV['DB_USERNAME'] ?? 'test';
		$_ENV['DB_PASSWORD'] = $_ENV['DB_PASSWORD'] ?? 'test';

		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}

        /**
         * We want to check, if the GET request on the '/' url (which is the url for the 
         * Home page) will load the Home page. So we simulate this request, by placing the GET and
         * '/' into the $_SERVER superglobal. That is as if browser hat sent this request.
         */
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/';
		$_SERVER['SERVER_PROTOCOL'] = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';

		ob_start();

        // This loads the application's entry point (front controller).
        // index.php reads $_SERVER values, runs the router,
        // calls the correct controller, and echoes the page content.
		require_once __DIR__ . '/../../../public/index.php';
        
		$output = ob_get_clean();

		$this->assertStringContainsString('Webpage Template', $output);
	}
}