<?php
include "../../Config/config.php";
require "../../Controllers/CommentsControllers/payCommentsController.php";

$obj = new payCommentsController();

try{
    $input = json_decode(file_get_contents('php://input'),true);
    switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['cve']) == true ){
            echo $obj -> listComments($_GET['fecha'], $_GET['cve']);
        }else{
            echo $obj -> listCommentsSearch($_GET['cve_cliente'],$_GET['fecha'],$_GET['id']);
        }
        break;
    case 'PATCH':
        echo $obj -> changeData($input);
        
        break;
    case 'DELETE':
        echo $obj -> deleteComment($_GET['id'],$_GET['clave_serv']);
        break;
    case 'POST':
        echo $obj -> createComment($input);
    }
}catch(Exception $e){
    echo json_encode(array(
        'status' => 'error',
        'info' => 'server error',
        'container' => $e
    ));
}
?>