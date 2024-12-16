<?php
    include "../../Config/config.php";
    require "../../Controllers/UsersControllers/usersController.php";
    
    $obj = new usersController();

    try{                
        $input = json_decode(file_get_contents('php://input'),true);
        switch($_SERVER['REQUEST_METHOD']){
            case 'GET':
                if(isset($_GET['cve'])){
                    echo $obj -> listUsers($_GET['cve']);
                }else{
                   echo $obj ->listUsersCities($_GET['id']);
                }
            break;
            case 'PATCH':
                echo $obj -> changeUser($_GET['cve']); 
            break;
            case 'DELETE':
                echo $obj -> deleteUser();
            break;            
            case 'POST':
                echo $obj -> insertUser($input);
                
            break;
        }
    }catch(Exception $e){
        echo  json_encode(array('status'=>"error",
        'info'=>"server error",
        'contenido'=>$e));
    }
    
?>