<?php
require "inc/function.inc.php";

//echo 'name:' . $_SESSION['name'];
//echo 'points:' . $_SESSION['points'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['name']) && isset($_POST['points'])) {
        // Get record based on the name given
        $data = DB::queryFirstRow("SELECT * FROM score_board WHERE name=%s", $_POST['name']);

        // switch to eastern time zone
        date_default_timezone_set("America/New_York");

        // create array for insertion/update to database
        $vars = array(
            'name' => $_POST['name'],
            'score' => $_POST['points'],
            'time' => date('Y-m-d h:i:s')
        );

        // if record exists, add item 'id'
        if (isset($data['id'])) {
            $vars['id'] = $data['id'];
        }

        // Insert of update database score_board
        DB::insertUpdate('score_board', $vars);

        // update score board
        $userLog->info('Player Submit New Score!', array('Playername' =>  $_SESSION['name'], 'New Score' => $_POST['points'], 'Time' => $currentDate));
      

        header("Location: players.php");
    }
}

$title = "Result";
$desc2 = "Result:";
include "inc/header.inc.php";
?>

</div>
<div class="loginform">

    <?php displayErrors(); ?>
    <form action="result.php" method="POST">
        <h3><?= $desc2 ?></h3>
        <br>
        <h3>Name: <?= $_SESSION['name'] ?></h3>
        <h3>Correct Answer: <?= $_SESSION['points'] ?> Questions</h3>
        <br>
        <fieldset>

            <div class="form-group">
                <label for="exampleInputEmail1" hidden>Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="name" name="name" value="<?= $_SESSION['name'] ?>" hidden>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" hidden>points</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password" name="points" value="<?= $_SESSION['points'] ?>" hidden>
            </div>
            <button type="submit" class="btn btn-primary">Submit Your Score</button>
            <button type="submit" class="btn btn-primary" formaction="index.php">Cancel</button>

        </fieldset>
    </form>

</div>

<?php include "inc/footer.inc.php"; ?>