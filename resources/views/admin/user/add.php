<?php
require_once('../../../autoload.php');
$session = new Session();
// if(!$session->check_if_valid()){
//     header("Location: login.php=?error=request-login");
// }

$scaffold = new Scaffolding("views");
$team_ctrl = new TeamController();
$league_ctrl = new LeagueController();
$teams = $team_ctrl->get_all_teams();
$leagues = $league_ctrl->get_all_leagues();

$scaffold->generate_header();
?>
    <div class='content-flex'>
        <form class='standard-form'>
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
                <legend>Team</legend>
                <select name="team">
                    <?php    /**PHP START */
                        $scaffold->generate_select($teams);
                    //PHP END ?>
                </select>
            </fieldset>

            <fieldset>
                <legend>League</legend>
                <select name="league">
                    <?php    /**PHP START */
                        $scaffold->generate_select($leagues);
                    //PHP END ?>
                </select>
            </fieldset>
        </form>
    </div>
<?php

$scaffold->generate_footer();



