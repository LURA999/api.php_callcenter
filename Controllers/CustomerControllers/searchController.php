<?php
require '../../Application/Customers/customerSearch.php';

class searchController {

    private $obj;

    function __construct(){
        $this->obj = new customerSearch();
    }

    function listUsers($cve){
        $this->obj = $this->obj -> getUsers($cve);
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


    function userCityList($clave,$ciudad){
        $this->obj = $this->obj -> getUserCityList($clave,$ciudad);
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

    function userStateList($clave,$estado){
        $this->obj = $this->obj -> getUserStateList($clave,$estado);
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

    function userStateAndCityList($clave,$ciudad,$estado){
        $this->obj = $this->obj -> getUserStateAndCityList($clave,$ciudad,$estado);
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

    function changeState(){
        $this->obj = $this->obj -> updateChangeState();
            return  json_encode(array(
                'status' => "ok",
                'info' => "updated",
                'container' => null
            ));
    }
}
?>