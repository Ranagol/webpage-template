<?php

// Here we do dotenv boostraping, to load variables from .env file into $_ENV superglobal
require __DIR__ . '/bootDotenv.php';

//Here we do Eloquent setup: we use Eloquent the same way is it is used in Laravel
require __DIR__ . '/bootEloquent.php';

//router setup: we use bramus router in order to activate with url's the controllers
require __DIR__ . '/../routes/routes.php';

/**
 * A little explanation here: this bootstrap.php file is directly connected with a 'require' to the
 * main index.php. This means, that these functions from bootstrap.php will be available everywhere
 * in the app. There are two imporant functions in bootstrap:
 * 1 - returnView()
 * 2 - redirect()
 * These two functions will be used by controllers, similar like in Laravel.
 */

use Dotenv\Dotenv;

/**
 * dotenv setup: we use dotenv to load all .env variables into the $_ENV superglobal, from where it 
 * will be available for further actions.
 * Create a new immutable dotenv instance with default repository, 
 * it's path must point to the app root dir
 * loads all .env variables into the $_ENV superglobal, from where they will be available to us
 */
$dotenv = Dotenv::createImmutable(__DIR__  . '/../');
$dotenv->load();

//Here we do Blade template engine setup
require __DIR__ . '/../bootstrap/bootBlade.php';

//Here we do Eloquent setup: we use Eloquent the same way is it is used in Laravel
require __DIR__ . '/../bootstrap/bootEloquent.php';

//router setup: we use bramus router in order to activate with url's the controllers
require __DIR__ . '/../routes/routes.php';

/**
 * This function will be used for returning views in the PageController.
 * It is similar to Laravel's view().
 * 
 * The first (mandatory) function is to create from this shit: return view('index') this shit here: 
 * return require 'views/index.view.php'.
 * The second (optional) function is if we have a variable in the controller page, 
 * and we want to pass that variable too to the view page. For example see the about() 
 * controller and the related about.view.php.
 * 
 * If the second argument for the view() is an array key/value pair, this function will 
 * add his $data=[] part, and that way an assoc. array will be created. For this, we will use the extract() 
 * function.
 * 
 * extract() will create variables from an assoc array. The variable name will be the key. 
 * The array value will the the variable value. That is it converts array keys into variable
 *  names and array values into variable value. Input : array("a" => "one", "b" => "two", "c" => "three"). 
 * Output :$a = "one" , $b = "two" , $c = "three".
 * Example: the about page. The PageController sends a $data variable to the about.php, that 
 * actually expects a $data variable, and wants to display it.
 *
 * @param string $name  Example: 'home' or 'contact' or 'about'
 * @param array $data   The data that we want to send to the views.
 *
 * @return void
 */
function returnView(string $name, array $data = []): void
{
    
    /**
     * Here we do php debugbar boostrapping, to show debugbar info in the desired page. So, if we call
     * the about page ($name = 'about'), the debugbar will be shown in the about page. The Debugbar
     * object created in the bootDebugbar.php will be available in the view page. The view will
     * require the header.php and footer.php. These two files will actullay trigger and use the Debugbar
     * object.
     * If the Debugbar object is only created in the bootDebugbar.php but would not have been required
     * into this function, then this function would not have access to the Debugbar object. Why? Because
     * a php function can only see things that are between the {}, or received by argument.
     */
    require_once __DIR__ . '/bootDebugbar.php';

    extract($data);

    // This opens the view file, and sends the data to it
    require __DIR__ . "/../resources/views/{$name}.view.php";
}

/**
 * Here we define our redirect() which will be used by controllers, similar to Laravel.
 *
 * @param string $path  This is path/page, where we want to redirect our user.
 * 
 * @return void
 */
function redirect(string $path): void
{
    /**
     * This is how redirect is done in vanilla php.
     */
    header("Location: /{$path}");
}
