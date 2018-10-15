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

$keys = [
    'sport','league','season','hometeam','awayteam','homescore','awayscore','scheduled','completed'
];

foreach($keys as $key){
    if(!isset($_GET[$key])) die("Missing parameters");
}

//values...
$sport = Sanitizer::sanitize($_GET['sport'],'select_int');
$league = Sanitizer::sanitize($_GET['league'],'select_int');
$season = Sanitizer::sanitize($_GET['league'],'select_int');
$hometeam = Sanitizer::sanitize($_GET['hometeam'],"text");
$awayteam = Sanitizer::sanitize($_GET['awayteam'],"text");
$homescore = Sanitizer::sanitize($_GET['homescore'],"select_int");
$awayscore = Sanitizer::sanitize($_GET['awayscore'],"select_int");
$scheduled = Sanitizer::sanitize($_GET['scheduled'],"datetime");
$completed = (integer)Sanitizer::sanitize($_GET['completed'],'bit');

$old_data = [$sport, $league, $season, $hometeam, $awayteam,$homescore,$awayscore,$scheduled,$completed];
$old_data = json_encode($old_data);


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
        <form class='standard-form' method='post' action='../../../endpoints/admin/schedule/modify.php'>
            <h4 class="form-title">Modify Schedule</h4>
            <input type='hidden' name="old_data" value='<?php echo $old_data ?>'>
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
                        <input name="homescore" value="<?php echo $homescore ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Away Score</legend>
                        <input name="awayscore" value="<?php echo $awayscore ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Scheduled - format is YYYY-MM-DD HH:MM:SS</legend>
                        <input name="scheduled" value="<?php echo $scheduled ?>">
                    </fieldset>

                    <fieldset>
                        <legend>Completed</legend>
                        <input name="completed" type="radio" value='0' <?php echo ($completed==0)?"checked":""?>>No
                        <input name="completed" type="radio" value='1' <?php echo ($completed==1)?"checked":""?>>Yes
                    </fieldset>
                </div>

                
            </fieldset>

            <input type='submit' value='Modify Schedule'>
        </form>
    </div>

    <script src="../../../../scripts/dynamicAdd.js"></script>
<?php
$scaffold->generate_footer();
?>