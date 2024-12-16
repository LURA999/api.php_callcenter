<?php
require '../../Config/database.php';

class citiesState extends database{

    function getCityState($ciudad, $estado){
        $sql = $this->connect()->prepare('select * from clientes where ciudad =:ciudad_ and estado= :estado_ and mostrar = 1');
        $sql -> bindParam(':ciudad_',$ciudad,PDO::PARAM_STR,35);
        $sql -> bindParam(':estado_',$estado,PDO::PARAM_STR,40);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getState($estado){
        $sql = $this->connect()->prepare('select * from clientes where estado =:estado_  and mostrar = 1');
        $sql -> bindParam(':estado_',$estado,PDO::PARAM_STR,40);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    function getCities($ciudad){
        $sql = $this->connect()->prepare('select * from clientes where ciudad =:ciudad_ and  mostrar = 1');
        $sql -> bindParam(':ciudad_',$ciudad,PDO::PARAM_STR,35);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCustomers(){
        $sql = $this->connect()->prepare('select * from clientes where mostrar = 1 order by nombre asc');
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateState($estado){
        $sql = $this->connect()->prepare('set :estado_ = 5;
        select * from clientes where mostrar = 1 order by nombre asc ');

        $sql -> bindParam(':estado_',$estado,PDO::PARAM_STR,40);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>