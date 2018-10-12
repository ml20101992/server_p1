<?php
require_once('../../../autoload.php');
$session = new Session();
if(!$session->check_if_valid()){
    header("Location: login.php=?error=request-login");
}

$scaffold = new Scaffolding("views");
$team_ctrl = new TeamController();
$league_ctrl = new LeagueController();
$teams = $team_ctrl->get_all_teams();
$leagues = $league_ctrl->get_all_leagues();

$scaffold->generate_header();

    if(isset($_GET['error'])){
        $message = "";

        switch ($_GET['error']){
            case "role-not-set": $message = "No role set";
                break;
            case "league-not-set": $message = "League not set";
                break;
            case "team-not-set": $message = "Team not set";
                break;
            case "username-taken":$message = "Username is taken";
                break;
            default: $message = 'Unknown error';
                break;
        }

        echo '<p class="error-message">'.$message.'</p>';
    }

    if(isset($_GET['status']) && $_GET['status'] === 'ok') echo '<p class="ok-message">User Created.</p>';
?>
    
    <div class='content-flex'>
        <form class='standard-form' method='post' action='../../../endpoints/admin/user/add_user.php'>
            <h4 class="form-title">Add New User</h4>
            <fieldset>
                <legend>Username</legend>
                <input name="username">
            </fieldset>

            <fieldset>
                <legend>Password</legend>
                <input name="password" type="password">
            </fieldset>

            <fieldset>
                <legend>Role</legend>
                <select name="role">
                    <option value='1'>Admin</option>
                    <option value="2">League Manager</option>
                    <option value="3">Team Manager</option>
                    <option value="4">Coach</option>
                    <option value="5">Parent</option>
                </select>
            </fieldset>

            <fieldset>
                <legend>League</legend>
                <select name="league">
                    <?php    /**PHP START */
                        $scaffold->generate_select($leagues,-1);
                    //PHP END ?>
                </select>
            </fieldset>

            <fieldset>
                <legend>Team</legend>
                <select name="team">
                    <?php    /**PHP START */
                        $scaffold->generate_select($teams,-1);
                    //PHP END ?>
                </select>
            </fieldset>

            <input type='submit' value='Add User'>
        </form>
    </div>
    
<?php

$scaffold->generate_footer();



