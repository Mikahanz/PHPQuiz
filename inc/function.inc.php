<?php

// This is going to be my main configuration file

//start session
session_start();

//include composers autoloader
require_once("vendor/autoload.php");
//MEEKRO - database variables
DB::$user = 'ipd_19';
DB::$password = 'ipdipd';
DB::$dbName = 'php_quiz_project';


//include composers autoloader
require("vendor/autoload.php");
// import the monolog library
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
$userLog = new Logger("User_Log_Events");
$userLog->pushHandler( new StreamHandler( "logs/users.log", Logger::DEBUG));

$errorMessage = ""; // variable to monitor errors
$WrongAnswerMessage = ""; // wrong answer message
$currentDate = date("l jS \of F Y h:i:s A");

/**
 * Validate if a given variable is empty
 *
 * @param [string] $field
 * @return boolean
 */
function isFieldEmpty($field)
{
    return (!isset($field) || trim($field) == "");
}

/**
 * Output error messages
 *
 * @return void
 */
function displayErrors()
{

    global $errorMessage; // use the variable that was created OUTSIDE the function.

    if ($errorMessage != "") { ?>
        <div class="alert alert-dismissible alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Important Information!</h4>
            <strong><?= $errorMessage;?></strong> 
        </div>
<?php }
}

/**
 * Output wrong answer
 *
 * @return void
 */
function displayWrongAnswer()
{

    global $WrongAnswerMessage; // use the variable that was created OUTSIDE the function.

    if ($WrongAnswerMessage != "") { ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Important Information!</h4>
            <strong><?= $WrongAnswerMessage;?></strong> 
        </div>
<?php }
}

/**
 * Verify if user is logged in using session variables.
 *
 * @return Boolean
 */
function loggedIn()
{
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        if (!isset($_SESSION['name'])) {
            $_SESSION['name'] = "Random Person";
        }
        return true;
    } else {
        return false;
    }
}

?>