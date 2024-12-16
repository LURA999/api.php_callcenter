<?php
require "../../Config/database.php";

class payment extends database {

    function insertPayment($clv, $fecha, $cantidad){
        $sql = "insert into pagos (clave_serv, fecha, cantidad) values(:clv,:fecha,:cantidad);";
        $sql = $this->connect()->prepare($sql);
        $sql->bindParam(':clv',$clv, PDO::PARAM_STR,20);
        $sql->bindParam(':fecha',$fecha, PDO::PARAM_STR,20);
        $sql->bindParam(':cantidad',$cantidad, PDO::PARAM_STR);
        $sql->execute();
        return $sql;
    }
    function getPayment($clave){
        $sql = "select * from pagos where clav_conv = :clv";
        $sql = $this->connect()->prepare($sql);
        $sql->bindParam(':clv',$clave, PDO::PARAM_STR,20);
        $sql->execute();
        return $sql;
    }
}

?>