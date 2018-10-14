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
        case "year-not-set":{
            $message = "Year Not Set";
        }break;

        case "descr-not-set":{
            $message = "Description not set.";
        }break;

        default: $message = 'Unknown error';
            break;
    }

    echo '<p class="error-message">'.$message.'</p>';
}

if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Team Created.</p>';

if(!isset($_GET['id'])) die("No ID provided");

$id = Sanitizer::sanitize($_GET['id'],'select_int');
$team = (new TeamController())->get_team_by_id($id);

$sls_col = (new SLSController())->get_all_sls();

$full_combo = array();
foreach($sls_col as $sls){
    $sport = ((new SportController())->get_sport_by_id($sls->get_sport()))->get_name();
    $league = ((new LeagueController())->get_league_by_id($sls->get_league()))->get_name();
    $season = ((new SeasonController())->get_season_by_id($sls->get_season()))->get_description();
    $sls_id = $sls->get_sport().'-'.$sls->get_league().'-'.$sls->get_season();
    $sls_name = $sport.'/'.$league.'/'.$season;

    $data['id'] = $sls_id;
    $data['name'] = $sls_name;
    array_push($full_combo,$data);
}
?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/team/modify.php'>
            <input type="hidden" value="<?php echo $team->get_id(); ?>" name="id">
            
            <h4 class="form-title">Modify Team</h4>
            <fieldset>
                <legend>Name</legend>
                <input name="name" value="<?php echo $team->get_name(); ?>">
            </fieldset>

            <fieldset>
                <legend>Mascot</legend>
                <input name="mascot" value="<?php echo $team->get_mascot(); ?>">
            </fieldset>

            <fieldset>
                <legend>Sport/League/Season</legend>
                <select name="sls">
                    <?php
                        foreach($full_combo as $combo){
                            echo '<option value="'.$combo['id'].'">'.$combo['name'].'</option>';
                        }
                    ?>
                </select>
            </fieldset>

            <fieldset>
                <legend>Picture </legend>
                <input name="picture" value="<?php echo $team->get_picture(); ?>">
            </fieldset>

            <fieldset>
                <legend>Home Color</legend>
                <input name="homecolor" value="<?php echo $team->get_homecolor(); ?>">
            </fieldset>

            <fieldset>
                <legend>Away Color</legend>
                <input name="awaycolor" value="<?php echo $team->get_awaycolor(); ?>">
            </fieldset>

            <fieldset>
                <legend>Max Players</legend>
                <input name="maxplayers" value="<?php echo $team->get_maxplayers(); ?>">
            </fieldset>

            <input type='submit' value='Modify Team'>
        </form>
    </div>


<?php
$scaffold->generate_footer();
?>