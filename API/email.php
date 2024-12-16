<?php
include '../Config/config.php';
require '../Controllers/emailControllers.php';

$obj = new emailControllers();

try{
    $input = json_decode(file_get_contents('php://input'),true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            echo $obj->listEmail($_GET['cve']);
            break;
        case 'PATCH':
            echo $obj->changeEmail($input);
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