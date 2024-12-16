<?php
require '../../Config/Database.php';

class serviceComments extends Database{

    function getComments($fecha, $cve){
        $sql = $this->connect()->prepare('select cve_usuario, categoria ,s.idcomentarios,idpagos,idconvenio,s.nombre, 
        comentario,  date_format(s.fecha,"%d-%m-%Y %H:%i:%s") fecha, date_format(fechac,"%d-%m-%Y %H:%i:%s") fechac,cantidadc,cantidadp, clav_conv, s.clave_serv from servicios_cliente sc 
		right outer join comentarios s on id = s.clave_serv and sc.clave_serv = :fecha_ 
		left outer join convenios c on c.clave_fech = s.fecha
        left outer join pagos p on p.fecha = s.fecha 
	    left outer join tusuario u on u.nombre = s.nombre 
        where s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_) and email = correo
        order by fecha desc');
        $sql->bindparam(':fecha_', $fecha, PDO::PARAM_STR,20);
        $sql->bindparam(':cve_', $cve, PDO::PARAM_STR,20);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function getCommentsSearch($cve_cliente,$fecha,$id){
        $sql = $this->connect()->prepare('select cve_usuario, categoria ,s.idcomentarios,idpagos,idconvenio,s.nombre, comentario,date_format(s.fecha,"%d-%m-%Y %H:%i:%s") fecha, date_format(fechac,"%d-%m-%Y %H:%i:%s") fechac,cantidadc,cantidadp, clav_conv, s.clave_serv from servicios_cliente sc 
        right outer join comentarios s on id = s.clave_serv
        left outer join convenios c on c.clave_fech = s.fecha
        left outer join pagos p on p.fecha = s.fecha 
	left outer join tusuario u on u.nombre = s.nombre 
        where  s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_cliente_)
        and s.idcomentarios = :id_  and email = correo
        or  s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_cliente_) and idpagos = :id_ 
        or s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_cliente_) and idconvenio = :id_');
        $sql->bindparam(':fecha_', $fecha, PDO::PARAM_STR,20);
        $sql->bindparam(':cve_cliente_', $cve_cliente, PDO::PARAM_STR,20);
        $sql->bindparam(':id_', $id, PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}

