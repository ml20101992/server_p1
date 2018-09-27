<?php
class Scaffolding{
    private $file_location;

    private $page_names = [
        "login"         => "Sports Manager Login",
        "admin"         => "Admin Panel",
        "team"          => "Team Panel",
        "schedule"      => "Schedule Panel",
        "other"         => ""
    ];

    private $page_name;

    public function __construct($pagename){
        $this->page_name = $pagename;
        
        $this->file_location = $this->generate_root_directory();
    }

    private function generate_root_directory(){
        $final_link = "";

        switch($this->page_name){
            case "other": $final_link = "../../";
                break;
            case "views": $final_link = "../../../../";
                break;
            default: $final_link = "../";
                break;
        }
        
        return $final_link;
    }

    public function generate_header(){
    ?>
    <!-- HTML START -->
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?php echo $this->page_names[$this->page_name] ?></title>
            <link rel="stylesheet" type="text/css" href="<?php echo $this->file_location?>css/style.css">
        </head>

        <body>
    <!-- HTML END -->
    <?php
    }

    public function generate_footer(){
    ?>
    <!-- HTML START -->
            <script src="<?php echo $this->file_location ?>scripts/script.js"></script>
        </body>
        </html>
    <!-- HTML END -->
    <?php
    }

    public function generate_navigation($username,$role){
    ?>
        <nav>
            <div class='nav-links'>
                <?php if ($role < 5) { ?>
                <a class='nav-element' href="admin.php">Admin</a>
                <?php } ?>
                <a class='nav-element' href="team.php">Team</a>
                <a class='nav-element' href="schedule.php">Schedule</a>
            </div>

            <div class='user-options'>
                <p class='nav-element username'><?php echo $username?></p>
                <button class='nav-element button-standard'>Logout</button>
            </div>
        </nav>
    <?php
    }

    private function generate_select_option($value,$name){
    ?>
        <option value="<?php echo $value; ?>"><?php echo $name; ?></option>

    <?php
    }

    public function generate_select($model_array){
        echo '<option value="null" type="hidden"></option>';

        foreach($model_array as $model){
            $this->generate_select_option($model->get_id(),$model->get_name());
        }
    }

}

?>