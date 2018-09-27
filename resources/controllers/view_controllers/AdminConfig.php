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
        $this->create_sidenav_sport_elements();
    }

    private function create_sidenav_user_elements(){
    // HTML BEGIN ?>
        <fieldset class="sidebar-element">
            <legend id='user' class="sidebar-element-toggle">User Controls</legend>
            <div class='holder collapsed'>
                <div class='sidebar-controls'>
                    <button class='sidebar-button' onclick="iframeChangeSource('user_add')">Add New User</button>
                    <button class='sidebar-button'>View Existing Users</button>
                    <button class='sidebar-button'>Edit Own User Data</button>
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
                    <button class='sidebar-button'>Add New Sport</button>
                    <button class='sidebar-button'>View Existing Sports</button>
                </div>
            </div>
        </fieldset>
    
    <?php /*HTML END*/ 
    }
}
?>