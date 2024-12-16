<?php
require '../Application/email.php';

class emailControllers{

    private $obj;

    function __construct(){
        $this->obj = new email();
    }

    function listEmail(){
        $this->obj = $this->obj->getEmail();
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'error',
                'info' => 'server error',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'email found',
                'container' => $this->$obj
            ));
        }
    }

    function changeEmail($input){
        try{
        $this->obj = $this->obj->updateEmail($input);
        return json_encode(array(
            'status' => 'ok',
            'info' => 'updated email',
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