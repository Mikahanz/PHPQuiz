<?php

require "inc/function.inc.php";


function endSession()
{
    // start session to have access to SESSION superglobal
    session_start();

    // remove all existing session data
    session_destroy();
    session_unset();
}



if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['name'])) {
        // Record Logout
        $userLog->info('Player has logged out!', array('Playername' => $_GET['name'], 'Time' => $currentDate));
    }
    

    if ($_GET['mode'] == "playerlogout") {
        // Record Logout
        $userLog->info('Player has logged out!', array('Playername' => $_SESSION['name'], 'Time' => $currentDate));

        // End Session
        endSession();

        //echo "mode admin passed";
        header('Location: login.php');
    }

    if ($_GET['mode'] == "admin") {
        // Record Logout
        $userLog->info('Player has logged out!', array('Playername' => $_SESSION['name'], 'Time' => $currentDate));

        // End Session
        endSession();

        //echo "mode admin passed";
        header('Location: loginadmin.php');
    }

    if ($_GET['mode'] == "adminlogout") {
        // Record Logout
        $userLog->info('Admin has logged out!', array('Username' => $_SESSION['name'], 'Time' => $currentDate));

        // End Session
        endSession();

        //echo "mode admin passed";
        header('Location: loginadmin.php');
    }

    if (!isset($_GET['mode'])) {
        // Record Logout
        $userLog->info('Player has logged out!', array('Username' => $_SESSION['name'], 'Time' => $currentDate));

        // End Session
        endSession();

        // redirect
        header("Location: login.php");
    }
}
