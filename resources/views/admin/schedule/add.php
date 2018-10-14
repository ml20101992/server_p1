<?php
require_once('../../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

$scaffold = new Scaffolding("views");
$scaffold->generate_header();

if($_SESSION['session_data']['user_role'] > 2) die("Insufficient Permissions"); 


if(isset($_GET['error'])){
    $message = "";

    switch ($_GET['error']){
        default: $message = 'Unknown error';
            break;
    }

    echo '<p class="error-message">'.$message.'</p>';
}

if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">Schedule Entry Created.</p>';


$sls_col = (new SLSController())->get_all_sls();

$full_combo = array();
foreach($sls_col as $sls){

    if(($_SESSION['session_data']['user_role'] === 1) || ($sls->get_league() === $_SESSION['session_data']['user_league'])){
        $sport = ((new SportController())->get_sport_by_id($sls->get_sport()))->get_name();
        $league = ((new LeagueController())->get_league_by_id($sls->get_league()))->get_name();
        $season = ((new SeasonController())->get_season_by_id($sls->get_season()))->get_description();
        $sls_id = $sls->get_sport().'-'.$sls->get_league().'-'.$sls->get_season();
        $sls_name = $sport.'/'.$league.'/'.$season;

        $data['id'] = $sls_id;
        $data['name'] = $sls_name;
        array_push($full_combo,$data);
    }
}

?>
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/schedule/add.php'>
            <h4 class="form-title">Add New Season</h4>
            <fieldset>
                <legend>Sport/League/Season</legend>
                <select name="sls" id="schedule_first">
                    <?php
                        foreach($full_combo as $combo){
                            echo '<option value="'.$combo['id'].'">'.$combo['name'].'</option>';
                        }
                    ?>
                </select>
                <div id="teams">

                </div>

                <div id="schedule_remainder" class="collapsed">
                    <fieldset>
                        <legend>Home Score</legend>
                        <input name="homescore">
                    </fieldset>

                    <fieldset>
                        <legend>Away Score</legend>
                        <input name="awayscore">
                    </fieldset>

                    <fieldset>
                        <legend>Scheduled - format is YYYY-MM-DD HH:MM:SS</legend>
                        <input name="scheduled">
                    </fieldset>

                    <fieldset>
                        <legend>Completed</legend>
                        <input name="homescore" type="radio" value='0' checked>No
                        <input name="homescore" type="radio" value='1'>Yes
                    </fieldset>
                </div>

                
            </fieldset>

            <input type='submit' value='Add Season'>
        </form>
    </div>

    <script src="../../../../scripts/dynamicAdd.js"></script>
<?php
$scaffold->generate_footer();
?>