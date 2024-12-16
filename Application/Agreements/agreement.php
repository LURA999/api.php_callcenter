<?php
require "../../Config/database.php";

class agreement extends database {

    function insertAgreement($clv, $fecha, $cantidad){
        $sql = $this->connect()->prepare("insert into convenios (clave_serv, fecha, cantidad) values(:clv,:fecha,:cantidad)");
        $sql->bindParam(':clv',$clv, PDO::PARAM_STR,20);
        $sql->bindParam(':fecha',$fecha, PDO::PARAM_STR,20);
        $sql->bindParam(':cantidad',$cantidad, PDO::PARAM_STR);
        $sql->execute();
        return $sql;
    }
    function getAgreement($nombre){
        if($nombre != ''){
        $sql = $this->connect()->prepare($this -> auxGetServCustomers(1)." order by idconvenio desc");
        $sql->bindParam(':nombre',$nombre, PDO::PARAM_STR,50);
        }else{
            $sql = $this->connect()->prepare($this -> auxGetServCustomers(0)." order by idconvenio desc"); 
        }
        $sql-> execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    function getAgreementsServ($clave){
        $sql = $this->connect()->prepare('select * from convenios where clave_fech= :clv');
        $sql->bindParam(':clv',$clave, PDO::PARAM_INT);
        $sql-> execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    function getExpired($nombre){
        if($nombre != ''){
            $sql = $this->connect()->prepare(
            $this -> auxGetServCustomers(1).' where date_add(now() , interval -1 day) > fechac order by idconvenio desc;');
            $sql ->bindParam(':nombre',$nombre,PDO::PARAM_STR, 40);
        }else{
            $sql = $this->connect()->prepare(
            $this -> auxGetServCustomers(0).' where date_add(now() , interval -1 day) > fechac order by idconvenio desc;');    
        }
        $sql-> execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    function getLastDays($nombre){
        if($nombre != ''){
            $sql = $this->connect()->prepare(
            $this -> auxGetServCustomers(1).' where date_add(now(), interval 4 day) >= fechac and fechac > date_add(now() , interval -1 day)
            order by idconvenio desc;');
            $sql ->bindParam(':nombre',$nombre,PDO::PARAM_STR, 40);
        }else{
            $sql = $this->connect()->prepare(
            $this -> auxGetServCustomers(0).'  where date_add(now(), interval 4 day) >= fechac and fechac > date_add(now() , interval -1 day)
            order by idconvenio desc;');
                
        }
        $sql-> execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
    function getValidity($nombre){
        if($nombre != ''){
            $sql = $this->connect()->prepare(
             $this -> auxGetServCustomers(1).' where fechac > date_add(now(), interval 4 day) order by idconvenio desc;');
             $sql ->bindParam(':nombre',$nombre,PDO::PARAM_STR, 40);
        }else{
            $sql = $this->connect()->prepare(
             $this -> auxGetServCustomers(0).' where fechac > date_add(now(), interval 4 day) order by idconvenio desc;');
        }
         $sql-> execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function auxGetServCustomers($opc){
        if($opc == 0){
            return 'select idconvenio, sc.clave_serv, 
        servicio, cantidad, idcliente, cl.nombre, colonia, calle,num,
        celular1, celular2,ciudad,cl.estado, estatus , date_format(fechac,"%d-%m-%Y %H:%i:%s") fechac 
        from servicios_cliente sc inner join comentarios s on id = s.clave_serv 
        inner join convenios c on c.clave_fech = s.fecha and c.estado =0
        inner join clientes cl on idcliente = idservicios
        and categoria = 2' ;
        }else{
            return 'select idconvenio, sc.clave_serv, 
        servicio, cantidad, idcliente, cl.nombre, colonia, calle,num,
        celular1, celular2,ciudad,cl.estado, estatus , date_format(fechac,"%d-%m-%Y %H:%i:%s") fechac 
        from servicios_cliente sc inner join comentarios s on id = s.clave_serv 
        inner join convenios c on c.clave_fech = s.fecha and c.estado =0
        inner join clientes cl on idcliente = idservicios and cl.nombre like "%":nombre"%"
        and categoria = 2';
        }
    }
}


?>