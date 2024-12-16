<?php
require '../../Application/Cities/citiesState.php';
class citiesStateControllers
{
    private $obj;

    function __construct() {
        $this->obj = new citiesState();
    } 

    function listCityState($ciudad, $estado)
    {
        $this->obj = $this->obj->getCityState($ciudad, $estado);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Cities and States not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Cities and States found",
                'container' => $this->obj
            ));
        }
    }

    function listState($ciudad)
    {
        $this->obj = $this->obj->getState($ciudad);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "State not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "State found",
                'container' => $this->obj
            ));
        }
    }
    
    function listCity( $ciudad){
        $this->obj = $this->obj->getCities($ciudad);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "cities not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "cities found",
                'container' => $this->obj
            ));
        }
    }

    function listCustomers(){
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

    function changeState($estado){
        $this->obj = $this->obj->updateState($estado);
        return  json_encode(array(
            'status' => "ok",
            'info' => "updated status",
            'container' => $this->obj
        ));
    }
}

?>