<?php
    require_once "../../Config/database.php";

    class serviceAgreements extends database {
        function getServices(){
            $cve = 2;
            $servicios = $this->connect()->prepare("select idconvenio, sc.clave_serv, 
            servicio, cantidad, idcliente, cl.nombre, colonia,calle, num, 
            celular1, celular2, ciudad, cl.estado, estatus , date_format(fechac,'%d-%m-%Y %H:%i:%s') fechac
            from servicios_cliente sc 
            inner join comentarios s on id = s.clave_serv  
            inner join convenios c on c.clave_fech = s.fecha and c.estado =0
            inner join clientes cl on idcliente = idservicios
            and categoria = :cve
            order by idconvenio desc");
            $servicios ->bindParam(':cve',$cve,PDO::PARAM_INT);
            $servicios->execute();
            $servicios = $servicios->fetchAll(PDO::FETCH_ASSOC);
            return $servicios;
        }

        function getAgreementsClient($nombre){
            $cve = 2;
            $servicios = $this->connect()->prepare("select idconvenio, sc.clave_serv, 
            servicio, cantidad, idcliente, cl.nombre, colonia,calle, num, 
            celular1, celular2, ciudad, cl.estado, estatus , date_format(fechac,'%d-%m-%Y %H:%i:%s') fechac
            from servicios_cliente sc 
            inner join comentarios s on id = s.clave_serv  
            inner join convenios c on c.clave_fech = s.fecha and c.estado =0
            inner join clientes cl on idcliente = idservicios
            and categoria = :cve 
            and cl.nombre like '%':nombre'%'
            order by idconvenio desc");
            $servicios ->bindParam(':cve',$cve,PDO::PARAM_INT);
            $servicios ->bindParam(':nombre',$nombre,PDO::PARAM_STR,40);
            $servicios->execute();
            $servicios = $servicios->fetchAll(PDO::FETCH_ASSOC);
            return $servicios;
        }
    }

?>