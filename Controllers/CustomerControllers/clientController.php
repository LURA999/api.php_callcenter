<?php
require '../../Application/Customers/customers.php';
class clientController
{
    private $obj;

    function __construct(){
        $this->obj = new customers();
    }    
    
    function insertClient($input)
    {
        $this->obj = $this->obj->createClient($input);
        return  json_encode(array(
            'estatus' => "ok",
            'info' => "customer created",
            'contenido' => null
        ));
    }

    function listClient($opc)
    {
        $this->obj = $this->obj->getCustomers($opc);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Clients not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Clients found",
                'container' => $this->obj
            ));
        }
    }

    function customerExists($cve){
        $this->obj = $this->obj->getCustomer($opc);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Clients not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Clients found",
                'container' => $this->obj
            ));
        }
    }
    function changeConfigurationState($input){
    try{
        $this->obj = $this->obj->updateConfigurationState($input);
        return  json_encode(array(
            'estatus' => "ok",
            'info' => "customer updated",
            'contenido' => null
        ));
    }catch(Exception $e){
        return  json_encode(array('status'=>"error",
        'info'=>$e->getMessage(),
        'container'=>null));
    }
    }

    function changeConfigurationStatus($input){
    try{
        $this->obj = $this->obj->updateConfigurationStatus($input);
        return  json_encode(array(
            'estatus' => "ok",
            'info' => "customer updated",
            'contenido' => null
        ));
    }catch(Exception $e){
        return  json_encode(array('status'=>"error",
        'info'=>$e->getMessage(),
        'container'=>null));
    }
    }

    function changeConfigurationShow($input){
        try{
            $this->obj = $this->obj->updateConfigurationShow($input);
            return  json_encode(array(
                'estatus' => "ok",
                'info' => "customer updated",
                'contenido' => null
            ));
        }catch(Exception $e){
            return  json_encode(array('status'=>"error",
            'info'=>$e->getMessage(),
            'container'=>null));
        }
        }
}

?>