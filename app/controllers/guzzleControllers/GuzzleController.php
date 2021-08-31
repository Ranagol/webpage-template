<?php

namespace App\Controllers\GuzzleControllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * The Guzzle class is ment for sending guzzle requests to https://dummyapi.io/.
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
     * Gets hardcoded 10 post data.
     * 
     * @throws Exception
     *
     * @return void
     */
    public static function getPosts(): void
    {
        //TODO LOSI LOSI CSINALJON EGY ASYNC REQUESTET
        //asyncNotWorking();
        //*************************** */
        $client = new Client();//it is ok to work with no arguments in the Client()
        $url = self::$baseUri . self::$postsUri;
        $headers = self::getHeaders();
        $request = new Request(
            'GET', 
            $url,
            $headers
        );
        //insert here try catch block
        try {
            $response = $client->send($request);
            $response = json_decode($response->getBody(), true);
            $posts = $response['data'];
            // var_dump($posts['data']);
            
            returnView('guzzle', compact('posts'));
        } catch (\Throwable $th) {
            var_dump('GUZZLE ERROR');
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
