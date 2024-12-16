<?php
include "../../Config/config.php";
require "../../Controllers/PaymentsControllers/paymentControllers.php";

$obj = new paymentControllers();
try{
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            echo $obj ->listPayment($_GET['clave']);
            break;
        case "POST":
            echo $obj ->createPayment($_GET['clv'], $_GET['fecha'], $_GET['cantidad']);
        break;
    }
}catch(Exception $e){
    echo  json_encode(array('status'=>"error",
                'info'=>"server error",
                'contenido'=>$e));
}
?>