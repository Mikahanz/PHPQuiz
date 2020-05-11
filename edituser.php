<?php
require "inc/function.inc.php";

// POST - LOGIN FORM
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pword = password_hash($_POST['pword'], PASSWORD_DEFAULT);

    echo $_POST['edittype'] . "post";

    // Validation to make sure fields are not empty
    if (isFieldEmpty($_POST['name']) || isFieldEmpty($_POST['email']) || isFieldEmpty($_POST['pword'])) {
        $errorMessage = "All fields are required";
    }

    // Check if there is no error, insert the record
    if ($errorMessage == "") {
        $vars = array('name' => $name, 'email' => $email, 'pword' => $pword);

        if (isset($_POST['id']) && is_numeric($_POST['id'])) {

            if($_POST['edittype'] == 'editadmin'){
                // log admin update
            $userLog->alert('Administrator Record Has Been Updated!', array('Adminname' => $_SESSION['name'], 'Time' => $currentDate));
            }

            if($_POST['edittype'] == 'editplayer'){
                // log admin update
            $userLog->alert('Player Record Has Been Updated!', array('Playername' => $_SESSION['name'], 'Time' => $currentDate));
            }            
            
            $vars['id'] = $_POST['id'];

        }else{
            if($_POST['edittype'] == 'editplayer'){
                // log player create
            $userLog->alert('Player Record Has Been Create!', array('Playername' => $_POST['name'], 'Time' => $currentDate));
            }

            if($_POST['edittype'] == 'editadmin'){
                // log admin create
            $userLog->alert('Administrator Record Has Been Create!', array('Adminname' => $_POST['name'], 'Time' => $currentDate));
            }

        }

        // Update user info
        if($_POST['edittype'] == 'editplayer'){
            
            DB::insertUpdate('players', $vars);
            header("Location: logout.php?mode=playerlogout");
            
        }elseif($_POST['edittype'] == 'editadmin'){
            
            $vars['admin'] = 1;
            DB::insertUpdate('admin', $vars);
            header("Location: logout.php?mode=adminlogout");
        }
        
    }
}

// GET - EDIT PLAYER
if ($_SERVER['REQUEST_METHOD'] == "GET") {


    if ($_GET['mode'] == "editplayer") {
        $playerID = $_SESSION['playerId'];

        $playerData = DB::queryFirstRow("SELECT * FROM players WHERE id=%i", $playerID);
        $playerid = $playerData['id'];
        $playername = $playerData['name'];
        $playeremail = $playerData['email'];
    }

    if($_GET['mode'] == "editadmin"){
        $adminID = $_SESSION['adminId'];

        $adminData = DB::queryFirstRow("SELECT * FROM admin WHERE id=%i", $adminID);
        $adminid = $adminData['id'];
        $adminname = $adminData['name'];
        $adminemail = $adminData['email'];
    }
}

$title = "Edit User";
$desc2 = "Edit User";
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
    <form action="edituser.php" method="POST">

        <h3><?= $desc2 ?></h3>
        <br>
        <fieldset>
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your Full Name" name="name" 
                value="<?php echo (isset($_POST['name'])) ? $name : "" ?> <?php echo ($_GET['mode'] == "editplayer") ? $playername: $adminname ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your info with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" 
                value="<?php echo (isset($_POST['email'])) ? $email : "" ?> <?php echo ($_GET['mode'] == "editplayer") ? $playeremail : $adminemail ?>">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="pword" 
                value="<?php echo (isset($_POST['pword'])) ? $_POST['pword'] : "" ?>">
            </div>

            <input type="text" class="form-control" id="exampleInputPassword1" name="id" 
            value="<?php echo (isset($_POST['name'])) ? $id : "" ?><?php echo ($_GET['mode'] == "editplayer") ? $playerid : $adminid ?>" hidden>

            <input type="text" class="form-control" id="exampleInputPassword1" name="edittype" value="<?php echo $_GET['mode'] ?>" hidden>
            <button type="submit" class="btn btn-primary" name="login">Update</button>
        </fieldset>
    </form>

</div>

<?php include "inc/footer.inc.php"; ?>