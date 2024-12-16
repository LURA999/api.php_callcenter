<?php
require '../Config/database.php';

class services_client extends database{

    function getRepeated($idcliente,$clave_serv2){
        $sql= $this->connect()->prepare("select count(idservicios) as total from servicios_cliente 
        where idservicios = :idcliente and clave_serv = :clave_serv2");
        $sql->bindParam(':idcliente',$idcliente,PDO::PARAM_STR,40);
        $sql->bindParam(':clave_serv2',$clave_serv2,PDO::PARAM_STR,20);
        $sql -> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }

    function getTotal($id){
        $sql= $this->connect()->prepare("select count(*)  as total from servicios_cliente where idservicios = :cve");
        $sql->bindParam(':cve',$id,PDO::PARAM_STR,40);
        $sql -> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }

    function getClientRepeated($cve_cliente){
        $sql= $this->connect()->prepare("select count(*) as repetido from clientes where idcliente = :idcliente_");
        $sql->bindParam(':idcliente_',$cve_cliente,PDO::PARAM_STR,40);
        $sql -> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    
    }
}


?>