<?php
require "inc/function.inc.php";

// POST - LOGIN FORM
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $pword = $_POST['pword'];

    // Get player record with that email
    $admin = DB::queryFirstRow("SELECT * FROM admin WHERE email=%s", $email);

    // Validation to make sure fields are not empty
    if (isFieldEmpty($_POST['email']) || isFieldEmpty($_POST['pword'])) {
        $errorMessage = "All fields are required";
    }

    if ($errorMessage == "") {

        // check if email exists
        if (!isset($admin['email'])) {
            $errorMessage = "Email is not registed";
        } else {

            // email exists

            //validate password
            if (!password_verify($_POST['pword'], $admin['pword'])) {
                $errorMessage = "Password does not match our records";
            } else {


                //set our session variables
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['adminId'] = $admin['id'];
                $_SESSION['name'] = $admin['name'];
                $_SESSION['admin'] = $admin['admin'];

                // Record Login
                $userLog->info('Admin has logged in!', array('Username' => $admin['name'], 'Time' => $currentDate));

                header('Location: adminhome.php');
            }
        }
    }
}

$title = "Admin Login";
$desc2 = "Admin Login";
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

            
        </ul>
        <a class="nav-link btn-secondary" href="login.php" <?php echo (loggedIn())? "hidden": ""?>>Login As Player</a>
       
    </div>
</nav>
</div>
<div class="loginform">
    
    <?php displayErrors(); ?>
    <form action="loginadmin.php" method="POST">
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
    <!-- <small class="form-text text-muted">Not yet a member? <a href="signup.php">Sign Up</a></small> -->
</div>

<?php include "inc/footer.inc.php"; ?>