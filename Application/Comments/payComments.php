<?php
require '../../Config/Database.php';

class payComments extends database{

    function getComments($fecha, $cve){
        $sql = $this->connect()->prepare('select cve_usuario,  
        idpagos, s.nombre, comentario, date_format(s.fecha,"%d-%m-%Y %H:%i:%s") fecha, cantidadp, date_format(fechap,"%d-%m-%Y 00:00:00") fechap, clav_conv, s.clave_serv, idcomentarios , estado
        from servicios_cliente sc 
		inner join comentarios s on id = s.clave_serv and sc.clave_serv = :fecha_
		inner join pagos p on p.fecha = s.fecha 
        inner join convenios c on clav_conv = idconvenio and estado = 0
	    inner join tusuario u on u.nombre = s.nombre and email = correo
        where s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_)order by idpagos desc');
        $sql->bindparam(':fecha_', $fecha, PDO::PARAM_STR,20);
        $sql->bindparam(':cve_', $cve, PDO::PARAM_STR,20);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    function updateComment($input){
        $sql = $this->connect()->prepare('update pagos set clav_conv = :idconvenio_, cantidadp = :cantidad_, fechap = :fecha_ 
        where  idpagos=:idpagos');
        $sql->bindparam(':cantidad_', $input['cantidad'],PDO::PARAM_STR);
        $sql->bindparam(':fecha_', $input['fecha2'],PDO::PARAM_STR,20);
        $sql->bindparam(':idconvenio_', $input['idconvenio'],PDO::PARAM_INT);
        $sql->bindparam(':idpagos', $input['clave_serv'],PDO::PARAM_INT);
        $sql->execute();

        $sql = $this->connect()->prepare('update comentarios set comentario = :comentario_ 
        where idcomentarios = :id_ ');
        $sql->bindparam(':comentario_', $input['comentario'],PDO::PARAM_STR,250);
        $sql->bindparam(':id_', $input['id'],PDO::PARAM_INT);
        $sql->execute();

        return $sql;
    }

    function deleteComment($id,$clave_serv){
        $sql = $this ->connect()->prepare('delete from pagos where idpagos=:idpagos');
        $sql->bindparam(':idpagos', $clave_serv,PDO::PARAM_STR,20);
        $sql->execute();
        
        $sql = $this ->connect()->prepare('delete from comentarios where idcomentarios = :id_');
        $sql->bindparam(':id_', $id,PDO::PARAM_INT);
        $sql->execute();
        return $sql;
    }
    
    function insertComment($input){
        $sql = $this ->connect()->prepare('insert into comentarios (clave_serv,fecha,comentario,nombre,correo,categoria)
        values( (select id from servicios_cliente where clave_serv =:clave_serv and idservicios = :cve_cliente), 
         concat(now(),""), :comentario, :nombre, :correo, :categoria)');
        $sql->bindparam(':clave_serv', $input['clave_serv'],PDO::PARAM_STR,20);
        $sql->bindparam(':cve_cliente', $input['cve'],PDO::PARAM_STR,20);
        $sql->bindparam(':comentario', $input['comentario'],PDO::PARAM_STR,250);
        $sql->bindparam(':nombre', $input['nombre'],PDO::PARAM_STR,40);
        $sql->bindparam(':correo', $input['correo'],PDO::PARAM_STR,50);
        $sql->bindparam(':categoria', $input['tipo'],PDO::PARAM_INT);
        $sql->execute();
        
        $sql = $this ->connect()->prepare('insert into pagos (clav_conv, fecha, cantidadp,fechap) 
        values( :clav_conv_,concat(now(),""),:cantidad_,:fecha_)');
        $sql->bindparam(':clav_conv_', $input['clave_conv'],PDO::PARAM_STR,20);
        $sql->bindparam(':cantidad_', $input['cantidad'],PDO::PARAM_STR);
        $sql->bindparam(':fecha_', $input['fecha'],PDO::PARAM_STR,20);
        $sql->execute();
       return $sql;
    }

    function getCommentsSearch($cve_cliente,$fecha,$id){
        $sql = $this->connect()->prepare('select cve_usuario, idpagos, s.nombre, comentario,  date_format(s.fecha,"%m-%d-%Y %H:%i:%s") fecha, cantidadp, date_format(fechap,"%m-%d-%Y 00:00:00") fechap, clav_conv, s.clave_serv, idcomentarios from servicios_cliente sc 
        inner join comentarios s on id = s.clave_serv 
        inner join pagos p on p.fecha = s.fecha 
	    inner join tusuario u on u.nombre = s.nombre and email = correo
        where   s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_cliente) 
        and idpagos = :id_');
        $sql->bindParam(":id_",$id,PDO::PARAM_INT);
        $sql->bindParam(":fecha_",$fecha,PDO::PARAM_STR,20);
        $sql->bindParam(":cve_cliente",$cve_cliente,PDO::PARAM_STR,20);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>