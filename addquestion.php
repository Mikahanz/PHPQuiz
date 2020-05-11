<?php
require "inc/function.inc.php";

// POST - LOGIN FORM
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Id = $_POST['id'];
    $question = $_POST['question'];
    $optionA = $_POST['optionA'];
    $optionB = $_POST['optionB'];
    $optionC = $_POST['optionC'];
    $optionD = $_POST['optionD'];
    $theAnswer = $_POST['answer'];

    // Get admin record with that email
    //$player = DB::queryFirstRow("SELECT * FROM admin WHERE email=%s", $email);

    // Validation to make sure fields are not empty
    if (isFieldEmpty($_POST['question']) || isFieldEmpty($_POST['optionA']) || isFieldEmpty($_POST['optionB']) || isFieldEmpty($_POST['optionC']) || isFieldEmpty($_POST['optionD']) ) {
        $errorMessage = "All fields are required";
    }

    if(isFieldEmpty($_POST['answer'])){
        $errorMessage = "Solution to the question is required!";
    }
   

    // Check if there is no error, insert the record
    if ($errorMessage == "") {

        $vars = array('question' => $question, 'option1' => $optionA, 'option2' => $optionB,'option3' => $optionC, 'option4' => $optionD, 'answer' => $theAnswer);

        // if POST['id'] isset then it's an update, else it's a create
        if(isset($_POST['id']) && is_numeric($_POST['id'])){
            // log Question update
            $userLog->alert('Question Record Has Been Updated!', array('Question' => $question, 'Adminname' => $_SESSION['name'], 'Time' => $currentDate));

            $vars['id'] = $_POST['id'];
        }else{
            // log question create
            $userLog->alert('Question Record Has Been Created!', array('Question' => $question, 'Adminname' => $_SESSION['name'], 'Time' => $currentDate));
        }

        DB::insertUpdate('questions', $vars);
        header("Location: adminhome.php");
    }
}

// GET - EDIT QUESTION
if($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET['id'])){

    }
    //ECHO $_GET['id'];
    $data = DB::queryFirstRow("SELECT * FROM questions WHERE id=%i", $_GET['id']);

    $id = $data['id'];
    $quest = htmlentities($data['question']);
    $optA = htmlentities($data['option1']);
    $optB = htmlentities($data['option2']);
    $optC = htmlentities($data['option3']);
    $optD = htmlentities($data['option4']);

    //echo $id;
    // echo $quest;
    // echo $optA;
    // echo $optB;
    // echo $optC;
    // echo $optD;

}

$title = "Add Question";
$desc2 = "Add Question";
include "inc/header.inc.php";
?>
</div>
<div class="loginform">
    <?php displayErrors(); ?>
    <form action="addquestion.php" method="POST">

        <h3><?= $desc2 ?></h3>
        <br>
        <fieldset>
            <div class="form-group">
                <label for="exampleInputEmail1">Question</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your question here" name="question" 
                value="<?php echo (isset($_POST['question'])) ? $question : "" ?><?php echo (isset($_GET['id'])) ? $quest: ""; ?>">
                <small id="emailHelp" class="form-text text-muted">Question is required!</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Option A</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Option A here" name="optionA" 
                value="<?php echo (isset($_POST['optionA'])) ? $optionA : "" ?><?php echo (isset($_GET['id'])) ? $optA: ""; ?>">
                <small id="emailHelp" class="form-text text-muted">Option A is required!</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Option B</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Option B here" name="optionB" 
                value="<?php echo (isset($_POST['optionB'])) ? $optionB : "" ?><?php echo (isset($_GET['id'])) ? $optB: "" ?>">
                <small id="emailHelp" class="form-text text-muted">Option B is required!</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Option C</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Option C here" name="optionC" 
                value="<?php echo (isset($_POST['optionC'])) ? $optionC : "" ?><?php echo (isset($_GET['id'])) ? $optC: "" ?>">
                <small id="emailHelp" class="form-text text-muted">Option C is required!</small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Option D</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Option D here" name="optionD" 
                value="<?php echo (isset($_POST['optionD'])) ? $optionD : "" ?><?php echo (isset($_GET['id'])) ? $optD: "" ?>">
                <small id="emailHelp" class="form-text text-muted">Option D is required!</small>
            </div>
            <input type="text" name="id" value="<?php echo (isset($_POST['id'])) ? $Id : "" ?><?php echo (isset($_GET['id'])) ? $id: "" ?>" hidden>
            <div class="form-group">
            <label for="exampleInputEmail1">Solution</label>
                <select class="custom-select" name="answer">
                    <option selected="" value="">Select Answer</option>
                    <option value="a">Option A</option>
                    <option value="b">Option B</option>
                    <option value="c">Option C</option>
                    <option value="d">Option D</option>
                </select>
                <small id="emailHelp" class="form-text text-muted">Answer to the question is required!</small>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Sibmit Question</button>
        </fieldset>
    </form>

</div>

<?php include "inc/footer.inc.php"; ?>