<?php
require '../Config/config.php';
require '../Controllers/services_clientControllers.php';

$obj = new services_clientControllers();

try{

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['cve']) == true){
                echo $obj->repeated($_GET['cve'], $_GET['cveserv']);
            }else if(isset($_GET['id']) == true) {
                echo $obj->total($_GET['id']);
            }else{
                echo $obj->clientRepeated($_GET['cve_cliente']);
            }
            break;
    }
}catch(Exception $e){
    return json_encode(array(
        'status' => 'error',
        'info'  => 'server error',
        'container' => $e
    ));
}
?>