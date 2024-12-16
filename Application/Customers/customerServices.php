<?php
require '../../Config/database.php';
class customerServices extends database{

    function insertServicesPerClient($input){
        $sql = "insert into servicios_cliente (idservicios,clave_serv,servicio,cantidad,interes)
        values(:idservicios_,:clave_serv_,:servicio_,:cantidad_,:interes_)"; 

        $sql = $this->connect()->prepare($sql);
        $sql->bindParam(':clave_serv_',$input['clave_serv'], PDO::PARAM_STR,40);
        $sql->bindParam(':servicio_',$input['servicio'],PDO::PARAM_STR,11);
        $sql->bindParam(':cantidad_',$input['cantidad'],PDO::PARAM_STR,100);
        $sql->bindParam(':interes_',$input['interes'],PDO::PARAM_STR,20);
        $sql->bindParam(':idservicios_',$input['cve'], PDO::PARAM_STR,20);
        $sql->execute();
        return $sql;
    }

    function ServicesPerClient($cve){
        $query = "select * from servicios_cliente where idservicios= :idservicios";
        $sql = $this->connect()->prepare($query);
        $sql->bindParam(':idservicios',$cve, PDO::PARAM_STR,20);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>