<?php
require '../../Application/Agreements/agreement.php';

class agreementControllers {
    private $obj;

    function __construct(){
        $this->obj = new agreement();
    }


    function createAgreement( $clv, $fecha, $cantidad){
       $this->obj = $this->obj->insertAgreement($clv, $fecha, $cantidad);
       return  json_encode(array(
        'estatus' => "ok",
        'info' => "agreement created",
        'contenido' => null
    ));
    }

    function listAgreements($nombre){
        $this->obj = $this->obj->getAgreement($nombre);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'not found',
                'info' => 'agreements not found',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'agreements found',
                'container' => $this->obj
            ));
        }
    }

    function listValidity($nombre){
        $this->obj = $this->obj->getValidity($nombre);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'not found',
                'info' => 'agreements not found',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'agreements found',
                'container' => $this->obj
            ));
        }
    }

    function listLastDays($nombre){
        $this->obj = $this->obj->getLastDays($nombre);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'not found',
                'info' => 'agreements not found',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'agreements found',
                'container' => $this->obj
            ));
        }
    }

    function listExpired($nombre){
        $this->obj = $this->obj->getExpired($nombre);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'not found',
                'info' => 'agreements not found',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'agreements found',
                'container' => $this->obj
            ));
        }
    }

    function listAgreementsServ($clave){
        $this->obj = $this->obj->getAgreementsServ($clave);
        if(count($this->obj) == 0){
            return json_encode(array(
                'status' => 'not found',
                'info' => 'agreements not found',
                'container' => []
            ));
        }else{
            return json_encode(array(
                'status' => 'ok',
                'info' => 'agreements found',
                'container' => $this->obj
            ));
        }
    }

}

?>