<?php
require "inc/function.inc.php";
include "randnumgen.php";

if(loggedIn()){
    
    $_SESSION['counter'] =1;
    $_SESSION['i'] = 0;
    $_SESSION['points'] = 0;
    // Login Time variable
    $_SESSION['loggedin_time'] = time();

    // Get all the records
    $questions = DB::query("SELECT * FROM questions");
    //echo count($questions)." questions";

    // get length of the array of records and assign it to $quantityQuest
    $quantityQuest = count($questions);

    // assign it to session variable
    $_SESSION['numOfQuest'] = $quantityQuest;

    // get random array of numbers from id column of database and assign it to session variable
    $_SESSION['questionIdNum'] = DB::queryFirstColumn("SELECT id FROM questions ORDER BY RAND()");

    header("Location: question.php");
}

$title = "Home";
$desc = "Home Page";
include "inc/header.inc.php";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php" onclick="return confirm('Are you sure you want to leave quiz session?\nYour points will be lost if you click OK.')">PHP Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            

            <li class="nav-item">
                <a class="nav-link btn-secondary" href="logout.php?mode=admin">Admin</a>
            </li>
        </ul>


    </div>
    <a class="nav-link btn-secondary" href="info.php" role="button">Website Info</a>
</nav>
</div>
</div>
<div class="jumbotron loginform">

    <p class="lead">This is a simple PHP quiz game to test your knowledge!</p>
    <hr class="my-4">
    <p>Number of questions: 7</p>
    <p>Type: Multiple Choice</p>
    <p>Given Time: 180 seconds</p>
    <p>Score: 1 point for each correct answer</p>

    <a class="btn btn-primary btn-lg" href="login.php" role="button">Start Game</a>
    
</div>
<?php include "inc/footer.inc.php"; ?>