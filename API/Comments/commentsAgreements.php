<?php
include "../../Config/config.php";
require "../../Controllers/CommentsControllers/commentsAgreementsController.php";

$obj = new commentsAgreementsController();
try{
    $input = json_decode(file_get_contents('php://input'),true);
    switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        if(isset($_GET['cve']) == true){
            echo $obj -> listComments($_GET['fecha'],$_GET['cve'],$_GET['opc']);
        } else {
            echo $obj -> listCommentsSearch($_GET['cve_cliente'],$_GET['fecha'],$_GET['id'], $_GET['opc']);
        }
        break;
    case 'PATCH':
        if(isset($input['idconvenio'])){
         echo $obj -> changeData($input);
        }else{
            echo $obj -> changeDataStatus($input);
        }
        break;
    case 'DELETE':
      
        break;
    case 'POST':
        echo $obj -> createComment($input);
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