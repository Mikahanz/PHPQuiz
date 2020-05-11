<?php
require "inc/function.inc.php";

// GET - Alter
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    //ECHO 'GET';

    $playerRec = DB::queryFirstRow('SELECT * FROM score_board WHERE id=%i', $_GET['id']);
    $questRec = DB::queryFirstRow('SELECT * FROM questions WHERE id=%i', $_GET['id']);

    // Delete Player
    if ($_GET['mode'] == "deleteplayer") {

        // Log Player Remove
        $userLog->warning('Player Score Record Has Been Removed!', array('Player' => $playerRec['name'], 'Score' => $playerRec['score'], 'Adminname' => $_SESSION['name'], 'Time' => $currentDate));

        DB::delete('score_board', 'id=%i', $_GET['id']);
    }

    // Delete Player
    if ($_GET['mode'] == "deletequestion") {
        // Log Question Remove
        $userLog->warning('Question Record Has Been Removed!', array('Question' => $questRec['question'], 'Adminname' => $_SESSION['name'], 'Time' => $currentDate));

        DB::delete('questions', 'id=%i', $_GET['id']);
    }

    // Edit Question
    if ($_GET['mode'] == "editquestion") {
        //echo 'edit question'. $_GET['id'];
        $id = $_GET['id'];

        header("Location: addquestion.php?id=$id");
    }
}

// Players Score Board Records
$playersData = DB::query("SELECT * FROM score_board ORDER BY score DESC");

// Questions Records
$questionsData = DB::query("SELECT * FROM questions ORDER BY id ASC");

$adminName = $_SESSION['name'];
$adminStatus = $_SESSION['admin'];
$title = "Admin Page";
$desc2 = "Player Score Board";
$desc3 = "Questions & Solutions";
include "inc/header.inc.php";
?>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">PHP Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addquestion.php">Add Questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#questions">Show Questions & Solutions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-secondary" href="edituser.php?mode=editadmin" onclick="return confirm('Are you sure you want to leave and logout of this page?\nYour points will be lost if you click OK.')">Edit Admin</a>
            </li>
        </ul>
        <a class="nav-link btn-secondary" href="logout.php?mode=adminlogout">Logout</a>
    </div>
</nav>

<br>
<h3>Administrator: <?= $adminName ?> </h3>
</div>

<h3 class="loginform" style="text-align: center"><?= $desc2 ?></h3>
<br>
<table class="table table-hover">
    <thead>
        <tr id="text_center" class="table-dark">
            <th scope="col">Rank</th>
            <th scope="col">Name</th>
            <th scope="col">Score</th>
            <th scope="col">Time Achieved</th>
            <th scope="col">Alter</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($playersData); $i++) : ?>
            <tr id="text_center" class="table-Light">
                <th scope="row"><?= $i + 1 ?></th>
                <th><?= $playersData[$i]['name'] ?></th>
                <th><?= $playersData[$i]['score'] ?></th>
                <th><?= $playersData[$i]['time'] ?></th>
                <th><a href="adminhome.php?id=<?= $playersData[$i]['id'] ?>&mode=deleteplayer" onclick="return confirm('Are you sure you want to delete <?= $playersData[$i]['name'] ?> with score: <?= $playersData[$i]['score'] ?>?')">Delete</a></th>
            </tr>
        <?php endfor ?>
    </tbody>
</table>
<br>
<h3 class="loginform" style="text-align: center"><?= $desc3 ?></h3>
<br>
<table class="table table-hover" id="questions">
    <thead>
        <tr id="text_center" class="table-dark">
            <th scope="col">Q No</th>
            <th scope="col">Question</th>
            <th scope="col">Option A</th>
            <th scope="col">Option B</th>
            <th scope="col">Option C</th>
            <th scope="col">Option D</th>
            <th scope="col">Solution</th>
            <th>Alter</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($questionsData); $i++) : ?>
            <tr id="text_center" class="table-Light">
                <th scope="row"><?= $i + 1 ?></th>
                <!-- <th><?= $questionsData[$i]['id'] ?></th> -->
                <th><?= $questionsData[$i]['question'] ?></th>
                <th><?= $questionsData[$i]['option1'] ?></th>
                <th><?= $questionsData[$i]['option2'] ?></th>
                <th><?= $questionsData[$i]['option3'] ?></th>
                <th><?= $questionsData[$i]['option4'] ?></th>
                <th><?= strtoupper($questionsData[$i]['answer']) ?></th>
                <th>
                    <a href="adminhome.php?id=<?= $questionsData[$i]['id'] ?>&mode=editquestion">Edit</a>
                    <a href="adminhome.php?id=<?= $questionsData[$i]['id'] ?>&mode=deletequestion" onclick="return confirm('Are you sure you want to delete the question No: <?= $questionsData[$i]['id'] ?>?')">Delete</a>
                </th>
            </tr>
        <?php endfor ?>
    </tbody>
</table>
<br>
<?php include "inc/footer.inc.php"; ?>