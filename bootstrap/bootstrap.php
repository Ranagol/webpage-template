<?php

declare(strict_types=1);

/**
 * A little explanation here: this bootstrap.php file is directly connected with a 'require' to the
 * main index.php. This means, that these functions from bootstrap.php will be available everywhere
 * in the app. There are two imporant functions in bootstrap:
 * 1 - returnView()
 * 2 - redirect()
 * These two functions will be used by controllers, similar like in Laravel.
 */

// Here we do Eloquent setup: we use Eloquent the same way is it is used in Laravel
require __DIR__ . '/../bootstrap/bootEloquent.php';

// router setup: we use bramus router in order to activate with url's the controllers
require __DIR__ . '/../routes/routes.php';

// Here we do dotenv setup
require __DIR__ . '/../bootstrap/bootDotenv.php';

/**
 * THIS FUNCTION IS BEING REPLACED BY BLADE VIEWS.
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
 * @param string               $name Example: 'home' or 'contact' or 'about'
 * @param array<string, mixed> $data the data that we want to send to the views
 */
function returnView(string $name, array $data = []): void
{
    extract($data);

    // This opens the view file, and sends the data to it
    require __DIR__ . "/../resources/views/{$name}.view.php";
}

/**
 * Here we define our redirect() which will be used by controllers, similar to Laravel.
 *
 * @param string $path this is path/page, where we want to redirect our user
 */
function redirect(string $path): void
{
    /*
     * This is how redirect is done in vanilla php.
     */
    header("Location: /{$path}");
}

/**
 * Returns a CSRF token and stores it in the current session.
 */
function csrf_token(): string
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/**
 * Validates an incoming CSRF token against the one in the current session.
 */
function validate_csrf_token(mixed $token): bool
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!is_string($token) || '' === $token) {
        return false;
    }

    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        return false;
    }

    return hash_equals($_SESSION['csrf_token'], $token);
}
