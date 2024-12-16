<?php
require '../../Config/Database.php';

class customerSearch extends database {

    function getUsers($clave){
        $sql= $this->connect()->prepare("select * from clientes where idcliente = :clave and mostrar = 1 order by idcliente asc");
        $sql->bindParam(':clave',$clave, PDO::PARAM_STR,40);
        $sql ->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserCityList($clave,$ciudad){
        $sql= $this->connect()->prepare("select * from clientes where idcliente = :clave 
        and ciudad = :_ciudad and mostrar = 1 order by idcliente asc");
        $sql->bindParam(':clave',$clave, PDO::PARAM_STR,40);
        $sql->bindParam(':_ciudad',$ciudad, PDO::PARAM_STR,40);
        $sql ->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserStateList($clave,$estado){
        $sql= $this->connect()->prepare("select * from clientes where idcliente = :clave 
        and estado = :_estado and mostrar = 1 order by idcliente asc");
        $sql->bindParam(':clave',$clave, PDO::PARAM_STR,40);
        $sql->bindParam(':_estado',$estado, PDO::PARAM_STR,40);
        $sql -> execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserStateAndCityList($clave,$ciudad,$estado){
        $sql= $this->connect()->prepare("select * from clientes where idcliente = :clave and estado = :_estado 
        and ciudad = :_ciudad and mostrar = 1 order by idcliente asc");
        $sql->bindParam(':clave',$clave, PDO::PARAM_STR,40);
        $sql->bindParam(':_ciudad',$ciudad, PDO::PARAM_STR,40);
        $sql->bindParam(':_estado',$estado, PDO::PARAM_STR,40);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    function updateChangeState($estado){
        $sql= $this->connect()->prepare("set :_estado = 5");
        $sql->bindParam(':_estado',$estado, PDO::PARAM_STR,40);
        $sql->execute();
        return $sql;
    }
}

?>