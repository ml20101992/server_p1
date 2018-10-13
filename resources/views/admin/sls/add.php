<?php
require_once('../../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

if($_SESSION['session_data']['user_role'] > 2) die("Insufficient Permissions");

$scaffold = new Scaffolding("views");
$sports = (new SportController())->get_all_sports();
$leagues = (new LeagueController())->get_all_leagues();
$seasons = (new SeasonController())->get_all_seasons();

$scaffold->generate_header();

if(isset($_GET['error'])){
    $message = "";

    switch ($_GET['error']){
        case "season-not-set":{
            $message = "Season Not Set";
        }break;

        case "sport-not-set":{
            $message = "Sport not set.";
        }break;

        case "league-not-set":{
            $message = "League not set.";
        }break;


        default: $message = 'Unknown error';
            break;
    }

    echo '<p class="error-message">'.$message.'</p>';
}

if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Sport/League/Season Created.</p>';

?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/sls/add.php'>
            <h4 class="form-title">Add New Sport/League/Season</h4>
            <fieldset>
                <legend>Sport</legend>
                <select name="sport">
                    <?php $scaffold->generate_non_null_option($sports) ?>
                </select>
            </fieldset>

            <fieldset>
                <legend>League</legend>
                <select name="league">
                    <?php $scaffold->generate_non_null_option($leagues) ?>
                </select>

            </fieldset>

            <fieldset>
                <legend>Season</legend>
                <select name="season">
                    <?php $scaffold->generate_non_null_option($seasons) ?>
                </select>
            </fieldset>
            <input type='submit' value='Add Sport/League/Season'>
        </form>
    </div>
<?php
$scaffold->generate_footer();
?>