<?php
require_once('../../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

if($_SESSION['session_data']['user_role'] > 2) die("Insufficient privileges");

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

$id = "";

if(isset($_GET['id'])){
    $id = Sanitizer::sanitize($_GET['id'],'select_int');
}

$season_ctrl = new SeasonController();
$season = $season_ctrl->get_season_by_id($id);


if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Season Modified.</p>';

?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/season/modify.php'>
            <h4 class="form-title">Modify Season</h4>
            <input type="hidden" name="id" value="<?php echo $season->get_id(); ?>">
            <fieldset>
                <legend>Season Description</legend>
                <input name="description" value="<?php echo $season->get_description(); ?>">
            </fieldset>

            <fieldset>
                <legend>Season Year</legend>
                <input name="year" value="<?php echo $season->get_year(); ?>">
            </fieldset>
            <input type='submit' value='Modify Season'>
        </form>
    </div>


<?php
$scaffold->generate_footer();
?>