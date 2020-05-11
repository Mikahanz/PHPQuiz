<?php
require "inc/function.inc.php";
// include "randnumgen.php";

// DATABASE CONNECTION HERE
//DB::insert('score_board', array('name' => 'michael', 'score' => 69, 'time' => date('Y-m-d h:i:s'))); // Connection good

// POST - LOGIN FORM
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pword = $_POST['pword'];

    // Get player record with that email
    $player = DB::queryFirstRow("SELECT * FROM players WHERE email=%s", $email);

    // Validation to make sure fields are not empty
    if (isFieldEmpty($_POST['email']) || isFieldEmpty($_POST['pword'])) {
        $errorMessage = "All fields are required";
    }

    if ($errorMessage == "") {

        // check if email exists
        if (!isset($player['email'])) {
            $errorMessage = "Email is not registed";
        } else {

            // email exists

            //validate password
            if (!password_verify($_POST['pword'], $player['pword'])) {
                $errorMessage = "Password does not match our records";
            } else {

                //set our session variables
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['name'] = $player['name'];
                $_SESSION['playerId'] = $player['id'];
                $_SESSION['solution'] = "";
                $_SESSION['points'] = 0;
                $_SESSION['counter'] = 1;
                $_SESSION['i'] = 0;

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

                // Record Login
                $userLog->info('Player has logged in!', array('Playername' => $player['name'], 'Time' => $currentDate));

                // redirect to question.php
                header('Location: question.php');
            }
        }
    }
}

$title = "Login";
$desc2 = "Player Login";
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
                <a class="nav-link btn-secondary" href="index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link btn-secondary" href="logout.php?mode=admin">Admin</a>
            </li>
        </ul>


    </div>
</nav>
</div>

</div>
<div class="loginform">

    <?php displayErrors(); ?>
    <form action="login.php" method="POST">
        <h3><?= $desc2 ?></h3>
        <br>
        <fieldset>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo (isset($_POST['email'])) ? $email : "" ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pword" value="<?php echo (isset($_POST['pword'])) ? $pword : "" ?>">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </fieldset>
    </form>
    <br><br>
    <small class="form-text text-muted">Not yet a member? <a href="signup.php">Sign Up</a></small>
</div>

<?php include "inc/footer.inc.php"; ?>