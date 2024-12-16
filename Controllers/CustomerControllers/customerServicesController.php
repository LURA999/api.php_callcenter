<?php
require '../../Application/Customers/customerServices.php';

class customerServicesController {

    private $obj;

    function __construct(){
        $this->obj = new customerServices();
    }

    function getCustomerServices($cve){
        $this->obj = $this->obj -> ServicesPerClient($cve);
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

    function createCustomerServices($input){
        $this->obj = $this->obj->insertServicesPerClient($input);
        return json_encode(array(
            'estatus' => "ok",
            'info' => "create service",
            'contenido' => null
        ));
    }
}
?>