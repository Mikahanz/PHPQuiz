<?php
require "inc/function.inc.php";

$playersData = DB::query("SELECT * FROM score_board ORDER BY score DESC");
//print_r($playersData);
//echo ($playersData[0]['name']);

$title = "Players";
$desc2 = "Players Score Board";
include "inc/header.inc.php";

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php" >PHP Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link btn-secondary" href="index.php">Play Again</a>
            </li>

            <li class="nav-item">
                <a class="nav-link btn-secondary" href="logout.php?mode=admin" onclick="return confirm('Are you sure you want to leave and logout of this page?\nYour points will be lost if you click OK.')">Admin</a>
            </li>
        </ul>
        
        <a class="nav-link btn-secondary" href="logout.php" <?php echo (!loggedIn())? "hidden": ""?>>Logout</a>
    </div>
</nav>
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
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i < count($playersData); $i++) : ?>
            <tr id="text_center" class="table-Light">
                <th scope="row"><?= $i+1 ?></th>
                <th><?= $playersData[$i]['name'] ?></th>
                <th><?= $playersData[$i]['score'] ?></th>
                <th><?= $playersData[$i]['time'] ?></th>
            </tr>
        <?php endfor ?>
    </tbody>
</table>

<?php include "inc/footer.inc.php"; ?>