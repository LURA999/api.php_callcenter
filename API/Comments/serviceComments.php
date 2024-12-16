<?php
include "../../Config/config.php";
require "../../Controllers/CommentsControllers/serviceCommentsController.php";

$obj = new serviceCommentsController();
try{
    switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['cve']) == true){
            echo $obj -> listComments($_GET['fecha'], $_GET['cve']);
        }else{
            echo $obj -> listCommentsSearch($_GET['cve_cliente'],$_GET['fecha'],$_GET['id']);
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