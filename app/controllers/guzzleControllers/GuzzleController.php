<?php

namespace App\Controllers\GuzzleControllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 * The GuzzleController class is meant for sending guzzle requests to https://dummyapi.io/.
 */
class GuzzleController
{
    /**
     * This is the base uri for the dummyApi page. 
     * We will send our requests here.
     *
     * @var string
     */
    private static $baseUri = 'https://dummyapi.io/data/v1/';

    /**
     * This is the additional uri that we need to make a get request regarding the posts.
     * page=0   give me only the first page
     * limit=10 give just 10 posts
     * 
     * Basically here we state that we want to get 10 posts.
     *
     * @var string
     */
    private static $postsUri = 'post?page=0&limit=10';

    /**
     * It is required to set app-id Header for each request.
     *
     * @var array
     */
    private static $headers = ['app-id' => '612de3a4265d8631fe1d0028'];

    /**
     * Loads guzzle page
     *
     * @return void
     */
    public static function loadGuzzlePage(): void
    {
        returnView('guzzle');
    }

    /**
     * Gets hardcoded 10 post data, by sending a GET request to the predefined url.
     * 
     * @throws Exception
     *
     * @return void
     */
    public static function getPosts(): void
    {   
        /**
         * This ['verify' => false] is a must, without this there will be some SSL error.
         */
        $client = new Client(['verify' => false]);
        $url = self::$baseUri . self::$postsUri;
        $headers = self::getHeaders();
        $request = new Request(
            'GET', 
            $url,
            $headers
        );

        try {

            /**
             * The request is send, and the response is received here.
             */
            $t = 8;
            $response = $client->send($request);//itt van a probléma
            $t = 8;

            $response = json_decode($response->getBody(), true);
            $posts = $response['data'];
            // var_dump($posts['data']);
            
            returnView('guzzle', compact('posts'));
            
        } catch (\Throwable $error) {
            // var_dump('GUZZLE ERROR');
            echo 'My error message: ' . $error->getMessage() . '<br>';
            echo 'The error was triggered in this file: ' . $error->getFile(). '<br>';
            echo 'The error was triggered on this line: ' . $error->getLine(). '<br>';

        }
    }

    public static function getHeaders(): array
    {
        return self::$headers;
    }
    
    public static function getPostsUri(): string
    {
        return self::$postsUri;
    }
   
    public static function getBaseUri(): string
    {
        return self::$baseUri;
    }
}
