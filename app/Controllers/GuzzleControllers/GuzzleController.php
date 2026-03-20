<?php

namespace App\Controllers\GuzzleControllers;

use App\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * The GuzzleController class is meant for sending guzzle requests to https://dummyapi.io/. Also for
 * displaying the received data.
 */
class GuzzleController extends Controller
{
    /**
     * This is the base uri for the dummyApi page.
     * We will send our requests here.
     *
     * @var string
     */
    private $baseUri = 'https://dummyapi.io/data/v1/';

    /**
     * This is the additional uri that we need to make a get request regarding the posts.
     * page=0   give me only the first page
     * limit=10 give just 10 posts.
     *
     * Basically here we state that we want to get 10 posts.
     *
     * @var string
     */
    private $postsUri = 'post?page=0&limit=10';

    /**
     * It is required to set app-id Header for each request.
     *
     * @var array<string, string>
     */
    private array $headers = ['app-id' => '612de3a4265d8631fe1d0028'];

    /**
     * Loads guzzle page.
     */
    public function loadGuzzlePage(): void
    {
        $this->view('guzzle');
    }

    /**
     * Gets hardcoded 10 post data, by sending a GET request to the predefined url.
     *
     * @throws \Throwable
     */
    public function getPosts(): void
    {
        /**
         * This ['verify' => false] is a must, without this there will be some SSL error.
         */
        $client = new Client(['verify' => false]);
        $url = $this->getBaseUri() . $this->getPostsUri();
        $headers = $this->getHeaders();
        $request = new Request(
            'GET',
            $url,
            $headers
        );

        try {

            /**
             * The request is send, and the response is received here.
             */
            $response = $client->send($request); // itt van a probléma
            $response = json_decode($response->getBody(), true);
            $posts = $response['data'];

            $this->view('guzzle', ['posts' => $posts]);

        } catch (\Throwable $error) {
            echo 'My error message: ' . $error->getMessage() . '<br>';
            echo 'The error was triggered in this file: ' . $error->getFile() . '<br>';
            echo 'The error was triggered on this line: ' . $error->getLine() . '<br>';
        }
    }

    /**
     * Returns the headers.
     *
     * @return array<string, string>
     */
    private function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Returns the posts uri.
     */
    private function getPostsUri(): string
    {
        return $this->postsUri;
    }

    /**
     * Returns the base uri.
     */
    private function getBaseUri(): string
    {
        return $this->baseUri;
    }
}
