<?php

use Dotenv\Dotenv;

//dotenv setup
$dotenv = Dotenv::createImmutable(__DIR__);//Create a new immutable dotenv instance with default repository
$dotenv->load();//loads all .env variables into the $_ENV superglobal, from where they will be available to us

//Eloquent setup 
require 'app/database/database.php';

//router setup
require 'app/router/routes.php';

/**
 * This function will be used for returning views in the PageController.
 * It is similar to Laravel's view().
 * The first (mandatory) function is to create from this shit: return view('index') this shit here: 
 * return require 'views/index.view.php'.
 * The second (optional) function is if we have a variable in the controller page, 
 * and we want to pass that variable too to the view page. For example see the about() 
 * controller and the related about.view.php.
 * If the second argument for the view() is an array key/value pair, this function will 
 * add his $data=[] part, and that way an assoc. array will be created. For this, we will use the extract() 
 * function.
 * extract() will create variables from an assoc array. The variable name will be the key. 
 * The array value will the the variable value. That is it converts array keys into variable
 *  names and array values into variable value. Input : array("a" => "one", "b" => "two", "c" => "three"). 
 * Output :$a = "one" , $b = "two" , $c = "three".
 *
 * @param String $name
 * @param Array $data
 */
function view(String $name, Array $data = [])
{
    extract($data);
    return require "app/webpage/views/{$name}.view.php";
}

/**
 * Here we boostrap our redirect() which will be used by PageController in page
 *
 * @param [type] $path
 * @return void
 */
function redirect($path)
{
    header("Location: /{$path}");
}
