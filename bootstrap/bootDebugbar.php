<?php

use DebugBar\StandardDebugBar;

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

