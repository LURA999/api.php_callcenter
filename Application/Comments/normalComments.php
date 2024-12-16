<?php
require '../../Config/Database.php';

class normalComments extends Database{

    function getComments($fecha, $cve){
        $sql = $this->connect()->prepare('select cve_usuario,idcomentarios,s.nombre,comentario,fecha,s.clave_serv from 
        comentarios s, servicios_cliente sc 
	inner join tusuario u 
        where id = s.clave_serv and sc.clave_serv = :fecha_ and categoria = 0 and u.nombre = s.nombre and email = correo
        and s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_) 
        order by idcomentarios desc');
        $sql->bindparam(':fecha_', $fecha, PDO::PARAM_STR,20);
        $sql->bindparam(':cve_', $cve, PDO::PARAM_STR,20);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function updateComment($input){
        $sql = $this->connect()->prepare('update comentarios set comentario=:comentario_ where idcomentarios = :id_');
        $sql->bindparam(':comentario_', $input['comentario'], PDO::PARAM_STR,250);
        $sql->bindparam(':id_', $input['id'], PDO::PARAM_INT);
        $sql->execute();
        return $sql;
    }

    function deleteComment($id){
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
       return $sql;
    }
    function getCommentsSearch($cve_cliente,$fecha,$id){
        $sql = $this->connect()->prepare("select cve_usuario, idcomentarios,s.nombre,comentario,fecha,s.clave_serv from comentarios s, servicios_cliente sc 
	inner join tusuario u 
        where id = s.clave_serv and sc.clave_serv = :fecha_ and categoria =0 and u.nombre = s.nombre and email = correo
            and s.clave_serv = (select id from servicios_cliente where clave_serv =:fecha_ and idservicios = :cve_cliente) and idcomentarios = :id_");
        $sql->bindParam(":id_",$id,PDO::PARAM_INT);
        $sql->bindParam(":fecha_",$fecha,PDO::PARAM_STR,20);
        $sql->bindParam(":cve_cliente",$cve_cliente,PDO::PARAM_STR,20);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>