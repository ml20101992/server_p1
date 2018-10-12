<?php
require_once('../../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

$scaffold = new Scaffolding("views");
$scaffold->generate_header();
if(isset($_GET['error'])){
    $message = "";

    switch ($_GET['error']){
        case "name-not-set":{
            $message = "Name Not Set";
        }break;
        case "name-taken": $message = "Sport Already Exists";
            break;
        default: $message = 'Unknown error';
            break;
    }

    echo '<p class="error-message">'.$message.'</p>';
}

if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Sport Created.</p>';

?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/sport/add.php'>
            <h4 class="form-title">Add New Sport</h4>
            <fieldset>
                <legend>Sport Name</legend>
                <input name="name">
            </fieldset>
            <input type='submit' value='Add Sport'>
        </form>
    </div>


<?php
$scaffold->generate_footer();
?>