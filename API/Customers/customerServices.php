<?php
include "../../Config/config.php";
require "../../Controllers/CustomerControllers/customerServicesController.php";

    $obj = new customerServicesController();
    try{
    switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
            echo $obj -> getCustomerServices($_GET['cve']);
        break;
    case 'POST':
            $input = json_decode(file_get_contents('php://input'),true);
            echo $obj -> createCustomerServices($input);
        break;
    }
    }catch(Exception $e){
        echo  json_encode(array('status'=>"error",
        'info'=>"server error",
        'container'=>$e));
    }

?>