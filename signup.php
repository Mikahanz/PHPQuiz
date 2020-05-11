<?php
require "inc/function.inc.php";

// POST - LOGIN FORM
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pword = password_hash($_POST['pword'], PASSWORD_DEFAULT);
    $cpword = $_POST['confirmpword'];

    // Get admin record with that email
    //$player = DB::queryFirstRow("SELECT * FROM admin WHERE email=%s", $email);

    // Validation to make sure fields are not empty
    if (isFieldEmpty($_POST['name']) || isFieldEmpty($_POST['email']) || isFieldEmpty($_POST['pword']) || isFieldEmpty($_POST['confirmpword'])) {
        $errorMessage = "All fields are required";

        
    }

    // Check if password the same as confirm password
    if($errorMessage == "" && $_POST['pword'] != $_POST['confirmpword']){
        $errorMessage = "Passwords does not matched";
    }

    // Check if there is no error, insert the record
    if ($errorMessage == "") {
        // log Create player
        $userLog->info('New Player Has Been Created!', array('PlayerName' => $name, 'Time' => $currentDate));
        DB::insert('players', array('name' => $name, 'email' => $email, 'pword' => $pword));
        header("Location: login.php");
    }
}

$title = "Sign Up";
$desc2 = "Signup";
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
<div class="loginform">
<?php displayErrors(); ?>
    <form action="signup.php" method="POST">

        <h3><?= $desc2 ?></h3>
        <br>
        <fieldset>
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your Full Name" name="name" value="<?php echo (isset($_POST['name'])) ? $name : "" ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your info with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?php echo (isset($_POST['email'])) ? $email : "" ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pword" value="<?php echo (isset($_POST['pword'])) ? $_POST['pword'] : "" ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="confirmpword" value="<?php echo (isset($_POST['confirmpword'])) ? $cpword : "" ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="login">Sign Up</button>
        </fieldset>
    </form>

</div>

<?php include "inc/footer.inc.php"; ?>