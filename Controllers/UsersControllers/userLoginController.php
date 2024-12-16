<?php
include_once '../../Application/Users/userLogin.php';

class userLoginController {
    private $obj;

    function __construct() {
        $this->obj = new userLogin();
    } 

    function userLogin ($user, $contrasena){
        $this->obj = $this->obj -> getLogin($user, $contrasena);
        if(count($this->obj) == 0){
            echo json_encode(array(
                'status' => 'not found',
                'info' => 'User not found',
                'container' => []
            ));
        }else{
            echo json_encode(array(
                'status' => 'ok',
                'info' => 'User found',
                'container' => $this->obj
            ));
        }
    }
    function userLoginPass ($input){
        try{
        $this->obj = $this->obj -> updateLoginPass($input);
        echo json_encode(array(
            'status' => 'ok',
            'info' => 'password updated',
            'container' => null
        ));
    }catch(Exception $e){
        return  json_encode(array('status'=>"error",
        'info'=>$e->getMessage(),
        'container'=>null));
    }
    }

    function userLoginLevel ($input){
        try{
        $this->obj = $this->obj -> updatedLoginLevel($input);
        echo json_encode(array(
            'status' => 'ok',
            'info' => 'password updated',
            'container' => null
        ));
    }catch(Exception $e){
        return  json_encode(array('status'=>"error",
        'info'=>$e->getMessage(),
        'container'=>null));
    }
    }
    
}

?>