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
 * @param string               $name Example: 'home'
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

    // After sending the header, we need to exit, otherwise the code will continue to execute.
    exit;
}

/**
 * Returns a CSRF token and stores it in the current session. This is used on the frontend.
 */
function csrfToken(): string
{
    // Check is session is started, if not, start it.
    if (PHP_SESSION_NONE === session_status()) {
        session_start();
    }

    // Check is there is a csrf token in the session, and if it is a string.
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {

        // If not, create a new one and store it in the session.
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // Return the csrf token from the session to the frontend
    return $_SESSION['csrf_token'];
}

/**
 * Validates an incoming CSRF token against the one in the current session. This is used on the
 * backend, in controllers.
 */
function validateCsrfToken(mixed $token): bool
{
    if (PHP_SESSION_NONE === session_status()) {
        session_start();
    }

    // If the csrf token from frontend is not a string, or is an empty string, return false.
    if (!is_string($token) || '' === $token) {
        return false;
    }

    // If there is no csrf token in the session, or it is not a string, return false.
    if (!isset($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
        return false;
    }

    // Compare the csrf token from the frontend with the one in the session
    // Returns TRUE when the two strings are equal, FALSE otherwise.
    return hash_equals($_SESSION['csrf_token'], $token);
}

function checkCsrfToken(mixed $token): void
{
    if (!validateCsrfToken($token)) {
        if (!headers_sent()) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        }
        echo 'Invalid CSRF token.';

        return;
    }
}
