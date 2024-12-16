<?php
require '../Config/database.php';

class email extends database{

    function getEmail($cve){
        $sql= $this->connect()->prepare("select email from tusuario where cve_usuario=:cve");
        $sql->bindParam(':cve',$cve,PDO::PARAM_STR,40);
        $sql -> execute();
        return $sql ->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateEmail($input){
        $sql= $this->connect()->prepare("update tusuario u set u.email = :email where u.cve_usuario = :id");
        $sql->bindParam(':id',$input['id'],PDO::PARAM_INT);
        $sql->bindParam(':email',$input['email'],PDO::PARAM_STR,40);
        $sql -> execute();
        return $sql;
    }
}


?>