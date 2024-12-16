<?php
include "../../Config/config.php";
require "../../Controllers/CitiesControllers/citiesControllers.php";

$obj = new citiesControllers();
try{
    switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['cve']) == false){
            echo $obj -> listCities();
        }else {
            if($_GET['opc']==1){
                echo $obj -> listCustomers();
            }else{ 
                echo $obj -> listCustomersSearch( $_GET['ciudad']);
            }
        }
        break;
    }
}catch(Exception $e){
    echo json_encode(array(
        'status' => 'error',
        'info' => 'server error',
        'container' => $e
    ));
}

?>