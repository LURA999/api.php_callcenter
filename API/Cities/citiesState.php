<?php
include "../../Config/config.php";
require "../../Controllers/CitiesControllers/citiesStateControllers.php";

$obj = new citiesStateControllers();
try{
    switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if($_GET['opc'] == 1 ) {
            echo $obj -> listCityState($_GET['ciudad'],  $_GET['estado']);
        }else if ($_GET['opc']==2) {
            echo $obj -> listState($_GET['estado']);
        }else if($_GET['opc']==3){
            echo $obj -> listCity( $_GET['ciudad']);
        }else{
            echo $obj -> listCustomers();
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