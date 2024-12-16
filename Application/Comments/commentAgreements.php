<?php
require '../../Config/database.php';

class commentAgreements extends Database{


    
    function getComments($fecha, $cve, $opc){
        $sql = $this->connect()->prepare('select cve_usuario,s.nombre,idconvenio, comentario, date_format(fecha,"%d-%m-%Y %H:%i:%s") fecha,
        date_format(fechac,"%d-%m-%Y 00:00:00") fechac,cantidadc, s.clave_serv, idcomentarios from servicios_cliente sc 
		inner join comentarios s on id = s.clave_serv and sc.clave_serv = :fecha_ 
		inner join convenios c on c.clave_fech = s.fecha
		inner join tusuario u on u.nombre = s.nombre and email = correo
        where c.estado = :opc_ and
        s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_)
		order by idconvenio desc');
        $sql->bindparam(':fecha_', $fecha, PDO::PARAM_STR,20);
        $sql->bindparam(':cve_', $cve, PDO::PARAM_STR,20);
        $sql->bindparam(':opc_', $opc, PDO::PARAM_STR,20);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateComment($input){
        $sql = $this->connect()->prepare('update convenios set fechac = :fecha_, cantidadc = :cantidad_ 
        where  idconvenio = :idconvenio');
        $sql->bindparam(':cantidad_', $input['cantidad'],PDO::PARAM_STR);
        $sql->bindparam(':fecha_', $input['fecha2'],PDO::PARAM_STR,20);
        $sql->bindparam(':idconvenio', $input['clave_serv'],PDO::PARAM_STR,20);
        $sql->execute();

        
        $sql = $this->connect()->prepare('update comentarios set comentario = :comentario_ 
        where idcomentarios = :id_ ');
        $sql->bindparam(':comentario_', $input['comentario'],PDO::PARAM_STR,250);
        $sql->bindparam(':id_', $input['id'],PDO::PARAM_INT);
        $sql->execute();
        return $sql;
    }
        
    function updateDateStatus($input){
        $sql = $this ->connect()->prepare('update  convenios set estado =:estado_  where  idconvenio= :id_');
        $sql->bindparam(':id_', $input['id'],PDO::PARAM_INT);
        $sql->bindparam(':estado_', $input['estado'],PDO::PARAM_INT);
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
        $sql = $this ->connect()->prepare('insert into convenios (clave_serv,fechac,cantidadc,clave_fech) 
        values( (select id from servicios_cliente where clave_serv =:clave_serv_ and idservicios = :cve_cliente_),
        :fecha_,:cantidad_,concat(now(),""))');

        $sql->bindparam(':clave_serv_', $input['clave_serv'],PDO::PARAM_STR,20);
        $sql->bindparam(':cve_cliente_',$input['cve'],PDO::PARAM_STR,20);
        $sql->bindparam(':fecha_', $input['fecha'],PDO::PARAM_STR,20);
        $sql->bindparam(':cantidad_', $input['cantidad'],PDO::PARAM_STR,20);
        $sql->execute();
        return $sql;
    }

    function getCommentsSearch($cve_cliente,$fecha,$id,$opc){
        $sql = $this->connect()->prepare('select cve_usuario,idconvenio,s.nombre, comentario, date_format(fecha,"%d-%m-%Y %H:%i:%s") fecha,
        date_format(fechac,"%d-%m-%Y 00:00:00") fechac,cantidadc, s.clave_serv, idcomentarios from servicios_cliente sc 
        inner join comentarios s on id = s.clave_serv
        inner join convenios c on c.clave_fech = s.fecha and c.estado = :opc
	    inner join tusuario u on u.nombre = s.nombre  and email = correo
         where s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_cliente)
        and idconvenio = :id_');
        $sql->bindParam(":id_",$id,PDO::PARAM_INT);
        $sql->bindParam(":fecha_",$fecha,PDO::PARAM_STR,20);
        $sql->bindParam(":cve_cliente",$cve_cliente,PDO::PARAM_STR,20);
        $sql->bindParam(":opc",$opc,PDO::PARAM_STR,20);

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>