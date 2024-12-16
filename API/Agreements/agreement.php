<?php
include "../../Config/config.php";
require "../../Controllers/AgreementsControllers/agreementControllers.php";

$obj = new agreementControllers();
try{
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            echo $obj ->createAgreement( $_GET['clv'],  $_GET['fecha'], $_GET['cantidad']);
        break;
        case 'GET':
	    if($_GET['opc'] == -1){
		    echo $obj ->listAgreements($_GET['nombre']);
	    }else if(isset($_GET['clave'])){
            echo $obj ->listAgreementsServ();
        }else{
            if($_GET['opc'] == 1){
                echo $obj ->listValidity($_GET['nombre']);
            }else if($_GET['opc'] == 2){
                echo $obj ->listLastDays($_GET['nombre']);
            }else{    
                echo $obj ->listExpired($_GET['nombre']);
            }
        }
        break;

    }

}catch(Exception $e){
    echo  json_encode(array('status'=>"error",
                'info'=>"server error",
                'contenido'=>$e));
}
?>