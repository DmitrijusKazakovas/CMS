<?php 
//main CMS file and functionality
class CMS_Core{
    public $Template, $Auth, $Database, $Cms;

    function __construct($server, $user, $pass, $db)
    {
        //db connect
        $this->Database= new mysqli($server, $user, $pass, $db);
        // create template object
        include(APP_PATH . "core/models/m_template.php");
        
        $this->Template = new Template();
        $this->Template->setAlertTypes(array('success', 'warning', 'error'));
        //create auth object
        include(APP_PATH . "core/models/m_auth.php");
        $this->Auth = new Auth();
        //create CMS object
        include(APP_PATH . "cms/models/m_cms.php");
        $this->Cms = new Cms();

        /* session start */
        session_start();
    }
    function __destruct()
    {
        $this->Database->close();
    }

    function head(){
        if($this->Auth->checkLoginStatus()){
            include(APP_PATH . "core/templates/t_head.php");
        }
        if (isset($_GET['login']) && $this->Auth->checkLoginStatus() == false){
            include(APP_PATH . "core/templates/t_login.php");
        }
    }

    function body_class(){
        if($this->Auth->checkLoginStatus()){
            echo "cms_editing";
        }
    }
    
    function toolbar(){
        if($this->Auth->checkLoginStatus()){
            include(APP_PATH . "core/templates/t_toolbar.php");
        }
    }
     ///problem here
    function login_link(){
        if($this->Auth->checkLoginStatus()){
            echo"<a href='" . SITE_PATH . "app/logout.php'>Logout</a>";
        }else{
            echo"<a href='app/login.php'>Login</a>";
        }
    }
}