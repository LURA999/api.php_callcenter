<?php
include "../../Config/config.php";
require "../../Controllers/CustomerControllers/clientController.php";

    $obj = new clientController();
try{

    $input = json_decode(file_get_contents('php://input'),true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if($_GET['opc']){
                echo $obj->listClient($_GET['opc']);
            }else if($_GET['cve']){
                echo $obj->customerExists($_GET['cve']);
            }
            break;
        case 'POST':
                echo $obj->insertClient($input);
            break;
        case 'PATCH':
            if(isset($input['estado'])){
                echo $obj->changeConfigurationState($input);
            }else if(isset($input['estatus'])){
                echo $obj->changeConfigurationStatus($input);
            }else if(isset($input['mostrar'])){
                echo $obj->changeConfigurationShow($input);
            }
        break;
    }
}catch(Exception $e){
    echo  json_encode(array('status'=>"error",
    'info'=>"server error",
    'container'=>$e));
}

?>