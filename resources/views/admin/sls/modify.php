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

if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Sport/League/Season Modified.</p>';

if(!(isset($_GET['sport']) && isset($_GET['season']) && isset($_GET['league']))){
    echo '<p class="error-message">No SLS combo selected</p>';
    return;
}

$sport = Sanitizer::sanitize($_GET['sport'],'select_int');
$season = Sanitizer::sanitize($_GET['season'],'select_int');
$league = Sanitizer::sanitize($_GET['league'],'select_int');

$sls = (new SLSController())->get_sls_by_key(['sport'=>$sport, 'league'=>$league, 'season'=>$season]);


?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/sls/modify.php'>
            <h4 class="form-title">Modify Sport/League/Season</h4>

            <input type="hidden" name="old_sport" value="<?php echo $sport ?>">
            <input type="hidden" name="old_league" value="<?php echo $league ?>">
            <input type="hidden" name="old_season" value="<?php echo $season ?>">


            <fieldset>
                <legend>Sport</legend>
                <select name="sport" selected="<?php echo $sport ?>">
                    <?php $scaffold->generate_non_null_option($sports) ?>
                </select>
            </fieldset>

            <fieldset>
                <legend>League</legend>
                <select name="league" selected="<?php echo $league ?>">
                    <?php $scaffold->generate_non_null_option($leagues) ?>
                </select>

            </fieldset>

            <fieldset>
                <legend>Season</legend>
                <select name="season" selected="<?php echo $season ?>">
                    <?php $scaffold->generate_non_null_option($seasons) ?>
                </select>
            </fieldset>
            <input type='submit' value='Modify Sport/League/Season'>
        </form>
    </div>
<?php
$scaffold->generate_footer();
?>