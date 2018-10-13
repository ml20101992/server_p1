<?php
class AdminConfig{
    private $role;

    public function __construct($role){
        $this->role = $role; 
    }

    public function init_content(){
    // HTML BEGIN ?>
        <div class="content">
            <div class='sidebar'>
                <?php $this->create_side_nav(); ?>
            </div>
            <iframe id="content_iframe" src="../resources/views/admin/user/modify.php"></iframe>
        </div>

    <?php /*HTML END*/
    }

    private function create_side_nav(){
        $this->create_sidenav_user_elements();
        if($this->role == 1) $this->create_sidenav_sport_elements();
        if($this->role < 3) $this->create_sidenav_season_elements();
        if($this->role < 3) $this->create_sidenav_sls_elements();
    }

    private function create_sidenav_user_elements(){
    // HTML BEGIN ?>
        <fieldset class="sidebar-element">
            <legend id='user' class="sidebar-element-toggle">User Controls</legend>
            <div class='holder collapsed'>
                <div class='sidebar-controls'>
                    <?php if ($this->role < 5){ ?><button class='sidebar-button' onclick="iframeChangeSource('user_add')">Add New User</button><?php } ?>
                    <?php if ($this->role < 5){ ?><button class='sidebar-button' onclick="iframeChangeSource('user_overview')">View Existing Users</button><?php } ?>
                    <button class='sidebar-button' onclick="iframeChangeSource('user_modify')">Edit Own User Data</button>
                </div>
            </div>
        </fieldset>
    
    <?php /*HTML END*/ 
    
    }

    private function create_sidenav_sport_elements(){
            // HTML BEGIN ?>
        <fieldset class="sidebar-element">
            <legend id='sport' class="sidebar-element-toggle">Sport Controls</legend>
            <div class='holder collapsed'>
                <div class='sidebar-controls'>
                    <button class='sidebar-button' onclick="iframeChangeSource('sport_add')">Add New Sport</button>
                    <button class='sidebar-button' onclick="iframeChangeSource('sport_overview')">View Existing Sports</button>
                </div>
            </div>
        </fieldset>
    
    <?php /*HTML END*/ 
    }

    private function create_sidenav_season_elements(){
        // HTML BEGIN ?>
    <fieldset class="sidebar-element">
        <legend id='sport' class="sidebar-element-toggle">Season Controls</legend>
        <div class='holder collapsed'>
            <div class='sidebar-controls'>
                <button class='sidebar-button' onclick="iframeChangeSource('season_add')">Add New Season</button>
                <button class='sidebar-button' onclick="iframeChangeSource('season_overview')">View Existing Seasons</button>
            </div>
        </div>
    </fieldset>

    <?php /*HTML END*/ 
    }

    private function create_sidenav_sls_elements(){
        // HTML BEGIN ?>
    <fieldset class="sidebar-element">
        <legend id='sport' class="sidebar-element-toggle">Sport/League/Season Controls</legend>
        <div class='holder collapsed'>
            <div class='sidebar-controls'>
                <button class='sidebar-button' onclick="iframeChangeSource('sls_add')">Add New Sport/League/Season</button>
                <button class='sidebar-button' onclick="iframeChangeSource('sls_overview')">View Existing Sport/League/Season</button>
            </div>
        </div>
    </fieldset>

    <?php /*HTML END*/ 
    }
    
}
?>