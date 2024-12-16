<?php
require '../../Application/Services/serviceAgreements.php';
class serviceAgreementsController {
    private $obj;

    function __construct() {
        $this->obj = new serviceAgreements();
    } 
    function servicesList (){
        $this->obj = $this->obj -> getServices();
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

    function servicesListName ($nombre){
        $this->obj = $this->obj -> getAgreementsClient($nombre);
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

}

?>