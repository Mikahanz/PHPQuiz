<?php
require "inc/function.inc.php";

$isAnswerSelected;

if (!loggedIn()) {
    header("Location: login.php");
}


$i = $_SESSION['i'];

$getQuestion = DB::queryFirstRow('SELECT * FROM questions WHERE id=%i', $_SESSION['questionIdNum'][$i]);


// POST - Submit Question
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    
      // Check if solution is good
    if ($_POST['optionsRadios'] == $_POST['theSolution']) {
        $_SESSION['points']++;
    }

    // Counter for number of questions
    if ($_SESSION['counter'] == 7) {
        
        $_SESSION['i'] = 0;

        header("Location: result.php");
    }

    if ($errorMessage == "") {
        //$counter = $_SESSION['counter'];
        $_SESSION['counter']++;
    }
}


// increment session variable
$_SESSION['i']++;

// Countdown counter
$countdown = (($_SESSION['loggedin_time'] + 180) - time());

$_SESSION['countdown'] = $countdown;

$accCode = $_SESSION['accesscode'];

if ($countdown < 1) {
    header("Location: result.php");
    //$userLog->notice('Time Expired', array('Access Code' => $_SESSION['accesscode']));
}
if($_SESSION['counter'] == 1){
    $errorMessage = "Leaving answer empty is considered incorrect answer was chosen!";
}


$title = "Question";
$desc2 = "Quiz Question";
$playerName = $_SESSION['name'];
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
                <a class="nav-link btn-secondary" href="players.php">Score Board</a>
            </li>

            <li class="nav-item">
                <a class="nav-link btn-secondary" href="logout.php?mode=admin" onclick="return confirm('Are you sure you want to leave and logout of this page?\nYour points will be lost if you click OK.')">Admin</a>
            </li>

            <li class="nav-item">
                <a class="nav-link btn-secondary" href="edituser.php?mode=editplayer" onclick="return confirm('Are you sure you want to leave and logout of this page?\nYour points will be lost if you click OK.')">Edit Player</a>
            </li>
        </ul>
        <a class="nav-link btn-secondary " href="index.php" onclick="return confirm('Are you sure you want to leave quiz session?\nYour points will be lost if you click OK.')">Reset Quiz<span class="sr-only">(current)</span></a>
        <a class="nav-link btn-secondary" href="logout.php" <?php echo (!loggedIn()) ? "hidden" : "" ?>>Logout</a>
    </div>
</nav>
<br>
<h3 style="text-align: center"><?= $playerName ?></h3>

</div>
<div class="loginform">

    <?php displayWrongAnswer(); ?>
    <?php displayErrors(); ?>
    <h3><?= $desc2 ?></h3>
    <div class="alert alert-dismissible alert-primary">

        <strong>Question <?= $_SESSION['counter'] ?> out of 7 </strong>
        <br>
        <strong>You have <?= $_SESSION['countdown'] ?> seconds to complete the Quiz</strong>


    </div>

    <form action="question.php" method="POST">
        <legend>Question</legend>
        <div class="form-group row">

            <div class="col-sm-10">

                <strong><?= $getQuestion['question'] ?></strong>
            </div>
        </div>
        <fieldset class="form-group">

            <legend>Answers</legend>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="a">
                    a. <?= $getQuestion['option1'] ?>
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="b">
                    b. <?= $getQuestion['option2'] ?>
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="c">
                    c. <?= $getQuestion['option3'] ?>
                </label>
            </div>
            <div class="form-check disabled">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="d">
                    d. <?= $getQuestion['option4'] ?>
                </label>
            </div>
            <input type="text" class="form-check-input" name="theSolution" id="optionsRadios3" value="<?= $getQuestion['answer'] ?>" hidden>
            <br>
            <button type="submit" class="btn btn-primary" name="submitanswer">Submit</button>
        </fieldset>
    </form>

</div>


<?php include "inc/footer.inc.php"; ?>