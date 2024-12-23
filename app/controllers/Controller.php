<?php

namespace App\controllers;

use Jenssegers\Blade\Blade;

/**
 * This is the parent class for all web page diplaying (non api related) controllers.
 */
class Controller
{
    /**
     * The Blade instance. The full Blade setup is happening here in the Controller class. Any class
     * that inherits this class will have access to the Blade instance. So all controllers that need
     * to display blade views will inherit this class.
     *
     * @var Blade
     */
    protected $blade;

    /**
     * The views directory.
     *
     * @var string
     */
    protected $views;

    /**
     * The cache directory.
     *
     * @var string
     */
    protected $cache;

    /**
     * The constructor.
     */
    public function __construct()
    {
        /**
         * This is how we can get into the root dir. Which is needed to get the absolute path to the 
         * views and cache directories. Here we say: navigate 2 levels up from the current directory.
         * So, this does not get us automatically to root dir, we tell it to go 2 levels up.
         */
        $rootDir = dirname(__DIR__, 2); 

        // The blade views are at the resources/views directory.
        $this->views = $rootDir . '/resources/views';
        $this->cache = $rootDir . '/cache';// The blade cache is at the bootstrap/cache directory.
        $this->blade = new Blade($this->views, $this->cache);
    }

    /**
     * Displays the Blade view.
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    public function view(string $view, array $data = []): void
    {
        echo $this->blade->render($view, $data);
    }
}
