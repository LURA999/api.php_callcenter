<?php
require '../../Config/database.php';
class customers extends database{

    function createClient($input){
        $sql = $this->connect()->prepare("insert into clientes (idcliente ,nombre , colonia , calle, num,
        celular1 , celular2 , ciudad ,  estado) values(:cve,:nombre,:colonia,:calle,:num,:celular1,:celular2,:ciudad,:estado)");
        $sql->bindParam(':cve',$input['cve'],PDO::PARAM_STR,40);
        $sql->bindParam(':nombre',$input['nombre'],PDO::PARAM_STR,45);
        $sql->bindParam(':colonia',$input['colonia'],PDO::PARAM_STR,25);
        $sql->bindParam(':calle',$input['calle'],PDO::PARAM_STR,25);
        $sql->bindParam(':num',$input['num'],PDO::PARAM_STR);
        $sql->bindParam(':celular1',$input['celular1'],PDO::PARAM_INT);
        $sql->bindParam(':celular2',$input['celular2'],PDO::PARAM_INT);
        $sql->bindParam(':ciudad',$input['ciudad'],PDO::PARAM_STR,35);
        $sql->bindParam(':estado',$input['estado'],PDO::PARAM_STR,35);
        $sql->execute();
        return $sql;
    }

    function getCustomers($opc){
        $sql = $this->connect()->prepare("select * from clientes where mostrar = :idshow order by nombre asc");
        $sql->bindParam(':idshow',$opc,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCustomer($cve){
        $sql = $this->connect()->prepare("select count(*) as existe from clientes where idcliente=:cve");
        $sql-> bindParam(':cve',$cve,PDO::PARAM_STR,40);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateConfigurationState($input){
        $sql = $this->connect()->prepare("update clientes set estado = :estado where idcliente=:iddcliente_");
        $sql->bindParam(':estado',$input['estado'],PDO::PARAM_INT);
        $sql->bindParam(':iddcliente_',$input['cve'],PDO::PARAM_STR,40);
        $sql->execute();
        return $sql;
    }

    function updateConfigurationStatus($input){
        $sql = $this->connect()->prepare("update clientes set estatus = :estatus where idcliente=:iddcliente_");
        $sql->bindParam(':estatus',$input['estatus'],PDO::PARAM_INT);
        $sql->bindParam(':iddcliente_',$input['cve'],PDO::PARAM_STR,40);
        $sql->execute();
        return $sql;
    }
    
    function updateConfigurationShow($input){
        $sql = $this->connect()->prepare("update clientes set mostrar = :mostrar_ where idcliente=:iddcliente_");
        $sql->bindParam(':mostrar_',$input['mostrar'],PDO::PARAM_INT);
        $sql->bindParam(':iddcliente_',$input['cve'],PDO::PARAM_STR,40);
        $sql->execute();
        return $sql;
    }
}

?>