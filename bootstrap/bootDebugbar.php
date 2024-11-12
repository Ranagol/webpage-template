<?php

use DebugBar\StandardDebugBar;

// Create a new DebugBar instance
$debugbar = new StandardDebugBar();
$debugbarRenderer = $debugbar->getJavascriptRenderer();
$debugbarRenderer->setBaseUrl('/debugbar');

// Make the variable global
$GLOBALS['debugbarRenderer'] = $debugbarRenderer;

// Add some data to the DebugBar
$debugbar["messages"]->addMessage("Hello world!");



