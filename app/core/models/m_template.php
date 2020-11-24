<?php

/*display templates, alerts, erros*/

class Template{
    
    private $data;
    private $alertTypes;

    /*Constructor*/

    function __construct() {}  

    /*Functions*/

    function load($url){
        include($url);
    }

    function redirect($url){
        header("Location: $url");
    }

    /*Get and Set*/

    function setData($name, $value, $clean = true){
        if ($clean){
            $this->data[$name] = htmlentities($value, ENT_QUOTES);
        }else{
            $this->data[$name] = $value;
        }        
    }

    function getData($name){
        if (isset($this->data[$name])){
            return $this->data[$name];
        }
        else{
            return '';
        }
    }

    /*Get and Set alerts*/

    function setAlertTypes($types){
        $this->alertTypes = $types;
    }

    function setAlert($value, $type = null){
        if ($type == '') {$type = $this->alertTypes[0];}
        $_SESSION[$type][] = $value;
    }
    
    function getAlerts(){
        $data = '';
        foreach($this->alertTypes as $alert){
            if (isset($_SESSION[$alert])){
                foreach($_SESSION[$alert] as $value){
                    $data .= '<li class="' . $alert . '">' . $value . '</li>';
                }
                unset($_SESSION[$alert]);
            }
        }
        return $data;
    }
    function error($type = '', $message = ''){
        if ($type = 'unauthorized'){
            $this->load(APP_PATH . 'core/views/v_unauthorized.php');
        }else{
            if ($message != ''){
                $this->setData('message', $message);
            }
            else{
                $this->setData('message', "Error. Please contact the administrator");
            }
            $this->load(APP_PATH . 'core/views/v_error.php');
        }
    }
}
