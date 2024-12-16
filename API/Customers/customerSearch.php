<?php
include '../../Config/config.php';
require '../../Controllers/CustomerControllers/searchController.php';

$obj = new searchController();

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if($_GET['opc']==5) {
                echo $obj -> listUsers($_GET['cve']);
            }else if ($_GET['estado'] == -1) {
                echo $obj -> userCityList($_GET['cve'],$_GET['ciudad']);
            }else if($_GET['ciudad'] ==-1) {
                echo $obj -> userStateList($_GET['cve'],$_GET['estado']);
            }else if($_GET['estado'] ==6){
                echo $obj -> changeState();
            } else{
                echo $obj -> userStateAndCityList($_GET['cve'],$_GET['ciudad'],$_GET['estado']);
            }
        break;
    }

?>