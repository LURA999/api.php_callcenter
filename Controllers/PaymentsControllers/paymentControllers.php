<?php
require '../../Application/Payments/payment.php';

class paymentControllers {
    private $obj;

    function __construct(){
        $this->obj = new payment();
    }


    function createPayment( $clv, $fecha, $cantidad){
       $this->obj = $this->obj->insertPayment($clv, $fecha, $cantidad);
       return  json_encode(array(
        'estatus' => "ok",
        'info' => "payment created",
        'contenido' => null
    ));
    }

    function listPayment( $clave){
        $this->obj = $this->obj->getPayment($clave);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Payment not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "payment found",
                'container' => $this->obj
            ));
        }
     }
}

?>