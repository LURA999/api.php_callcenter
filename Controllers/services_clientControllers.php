<?php
require '../Application/services_client.php';

class services_clientControllers{

    private $obj;

    function __construct(){
        $this->obj = new services_client();
    }

    function repeated($idcliente,$clave_serv2){
        $this->obj = $this->obj->getRepeated($idcliente,$clave_serv2);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'error',
                'info' => 'server error',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'found',
                'container' => $this->obj
            ));
        }
    }

    function total($id){
        $this->obj = $this->obj->getTotal($id);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'error',
                'info' => 'server error',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'found',
                'container' => $this->obj
            ));
        }
    }

    
    function clientRepeated($id){
        $this->obj = $this->obj->getClientRepeated($id);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'error',
                'info' => 'server error',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'found',
                'container' => $this->obj
            ));
        }
    }
}
?>