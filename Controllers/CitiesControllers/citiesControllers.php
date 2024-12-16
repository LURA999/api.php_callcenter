<?php
require '../../Application/Cities/cities.php';
class citiesControllers
{
    private $obj;

    function __construct() {
        $this->obj = new cities();
    } 

    function listComments()
    {
        $this->obj->getComments();
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Customers not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Customers found",
                'container' => $this->obj
            ));
        }
    }

    function listCustomers()
    {
        $this->obj = $this->obj->getCustomers();
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Customers not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Customers found",
                'container' => $this->obj
            ));
        }
    }
    
    function listCustomersSearch( $ciudad){
        $this->obj = $this->obj->getCustomersSearch($ciudad);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Customers not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Customers found",
                'container' => $this->obj
            ));
        }
    }

    function listCities(){
        $this->obj = $this->obj->getCities();
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Cities not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Customers found",
                'container' => $this->obj
            ));
        }
    }
}

?>