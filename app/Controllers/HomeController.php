<?php

namespace App\Controllers;

use DebugBar\StandardDebugBar;


class HomeController extends Controller
{
    /**
     * Loads the Home page.
     *
     * @return void
     */
    public function home(): void
    {
        $this->testDebugBar();

        //Use this line to check if xdebug is installed and the step debugger is enabled.
        // xdebug_info();

        $this->view('home');
    }

    /**
     * This function is not needed at all for displaying the home page. We use it to check the
     * Debugbar, to learn about it and test it.
     *
     * @return void
     */
    private function testDebugBar(): void
    {
        // Create a new DebugBar instance
        $debugbar = new StandardDebugBar();
        $debugbarRenderer = $debugbar->getJavascriptRenderer();

        /**
         * Here we actually state, that the Debugbar stuff needed to the browser so the Debugbar page could
         * be shown, is in the /public/debugbar folder. 
         */
        $debugbarRenderer->setBaseUrl('/debugbar');

        // Add some data to the DebugBar
        $debugbar["messages"]->addMessage("Hello world!");
        $debugbar['messages']->addMessage('This is a warning', 'warning');
        $debugbar['messages']->addMessage('This is an error', 'error');

        // Measuring time
        // Enable the time collector
        $debugbar['time']->startMeasure('operation_name', 'Operation Description');
        sleep(2);
        $debugbar['time']->stopMeasure('operation_name');
    }
}
