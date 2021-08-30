<?php

use Dotenv\Dotenv;


/**
 * dotenv setup: we use dotenv to load all .env variables into the $_ENV superglobal, from where it will be available for further actions
 * Create a new immutable dotenv instance with default repository, 
 * it's path must point to the app root dir
 * loads all .env variables into the $_ENV superglobal, from where they will be available to us
 */
$dotenv = Dotenv::createImmutable(__DIR__  . '/../');
$dotenv->load();

//Here we do Eloquent setup: we use Eloquent the same way is it is used in Laravel
require __DIR__ . '/../database/database.php';

//router setup: we use bramus router in order to activate with url's the controllers
require __DIR__ . '/../router/routes.php';

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
 * @param string $name
 * @param array $data
 *
 * @return void
 */
function returnView(String $name, Array $data = []):void
{
    extract($data);
    require __DIR__ . "/../resources/views/{$name}.view.php";
}

/**
 * Here we boostrap our redirect() which will be used by PageController in page
 *
 * @param string $path
 * 
 * @return void
 */
function redirect(string $path): void
{
    header("Location: /{$path}");
}
