<?php

require '../../Config/database.php';

class userLogin extends database{


    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    
    

    function getLogin($usuario, $contrasena){
    $query = $this->getUser($usuario);

    $cuenta = $query -> rowCount();

    if($cuenta > 0)
    {
        while($row = $query->fetch(PDO::FETCH_NUM))
        {
            if(password_verify($contrasena,$row[4]))
            {
                $headers = ['alg'=>'HS256','typ'=>'JWT'];
                $headers_encoded = $this->base64url_encode(json_encode($headers));

                $payload = ['sub'=>$row[0],'name'=>$row[1],'email'=>$row[2], 'level'=>$row[3],'time'=>3600];
                $payload_encoded = $this->base64url_encode(json_encode($payload));

                $key = 'secret';
                $signature = hash_hmac('SHA256',"$headers_encoded.$payload_encoded",$key,true);
                $signature_encoded = $this->base64url_encode($signature);

                $token = "$headers_encoded.$payload_encoded.$signature_encoded";
                echo json_encode(array("error"=>false,
                                       "token"=>$token));
                exit();
            }else
            {
                $err = array('error' => true);
                echo json_encode($err);
            }
        }
    }else{
        $err = array('error' => true);
        echo json_encode($err);
    }
     
    }

    function getUser($usuario){
        $sql = $this->connect()->prepare('select * from tusuario u where u.email = :usuario and u.estatus=1');
        $sql->bindparam(':usuario', $usuario, PDO::PARAM_STR,50);
        $sql->execute();
        return $sql;
    }
   

    function updateLoginPass($input){
        
        $sql = $this->connect()->prepare('update tusuario u set u.contrasena = :contrasena where u.cve_usuario = :cve_usuario');
        $sql->bindparam(':contrasena', password_hash( $input["contrasena"], PASSWORD_DEFAULT) , PDO::PARAM_STR);
        $sql->bindparam(':cve_usuario', $input['id'], PDO::PARAM_INT);
        $sql->execute();
        return $sql;
    }


    function updatedLoginLevel($input){
        $sql = $this->connect()->prepare('update tusuario u set u.nivel = :nivel where u.cve_usuario = :id');
        $sql->bindparam(':nivel', $input['nivel'], PDO::PARAM_STR,40);
        $sql->bindparam(':id', $input['id'], PDO::PARAM_INT);
        $sql->execute();
        return $sql;
    }

}


?>