<?php
require '../../Config/database.php';

class cities extends database{

    function getCities(){
        $sql = $this->connect()->prepare('select * from ciudades');
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCustomers(){
        $sql = $this->connect()->prepare('select CONCAT(UPPER(LEFT(ciudad, 1)), LOWER(SUBSTRING(ciudad, 2))) as ciudad from clientes  group by ciudad asc');
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCustomersSearch($ciudad){
        $sql = $this->connect()->prepare('select * from clientes where ciudad=:ciudad_');
        $sql -> bindParam(':ciudad_',$ciudad,PDO::PARAM_STR,35);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>