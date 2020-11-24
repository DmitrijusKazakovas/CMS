<?php 


class Auth {
    private $salt = '6YHgdb45P';
   
    //Constructor

    function __construct(){}

    //Funcs

    function validateLogin($user, $pass){
        //access db
        global $CMS;
        //create db query
        if ($stmt = $CMS->Database->prepare("SELECT * FROM users WHERE username = ? AND password = ?")){
            $stmt->bind_param("ss", $user, md5($pass . $this->salt));
            $stmt->execute();
            $stmt->store_result();

            //check rows

            if ($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
        }
        else{
            die("Error: MySQLi statement was not prepared");
        }
    }
    function checkLoginStatus(){
        if (isset($_SESSION['loggedin'])){
            return true;
        }else{
            return false;
        }
    }

    function checkAuthorization(){
        include('init.php'); 
        if ($this->checkLoginStatus() == false){
            $CMS->Template->error('unauthorized');
            exit;
        }
    }

    function logout(){
        session_destroy();
        session_start();
    }
} 