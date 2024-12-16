<?php
    include "../../Config/config.php";
    require "../../Controllers/ServicesControllers/serviceAgreementsController.php";
    
    $obj = new serviceAgreementsController();
    try{
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['nombre'])){
                echo $obj->servicesListName($_GET['nombre']);
            }else{
                echo $obj->servicesList();
            }
        break;
    }
}catch(Exception $e){
    echo  json_encode(array('status'=>"error",
    'info'=>"server error",
    'contenido'=>$e));
}    
?>