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
        case "desc-not-set":{
            $message = "Description Not Set";
        }break;

        case "year-not-set":{
            $message = "Year not set.";
        }break;
        case "name-taken": $message = "Season Already Exists";
            break;
        default: $message = 'Unknown error';
            break;
    }

    echo '<p class="error-message">'.$message.'</p>';
}

if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Season Created.</p>';

?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/season/add.php'>
            <h4 class="form-title">Add New Season</h4>
            <fieldset>
                <legend>Season Description</legend>
                <input name="description">
            </fieldset>

            <fieldset>
                <legend>Season Year</legend>
                <input name="year">
            </fieldset>
            <input type='submit' value='Add Season'>
        </form>
    </div>


<?php
$scaffold->generate_footer();
?>