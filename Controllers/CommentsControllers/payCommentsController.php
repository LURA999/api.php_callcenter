<?php
require '../../Application/Comments/payComments.php';
class payCommentsController
{
    private $obj;

    function __construct() {
        $this->obj = new payComments();
    } 

    function listComments($fecha, $cve){
        $this->obj = $this->obj->getComments($fecha,$cve);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Clients not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Clients found",
                'container' => $this->obj
            ));
        }
    }

    function changeData($input){
        $this->obj = $this->obj->updateComment($input);
        return  json_encode(array(
            'status' => "ok",
            'info' => "comment updated",
            'container' => null
        ));
    }

    function deleteComment($id,$clave_serv){
        $this->obj = $this->obj->deleteComment($id,$clave_serv);
        return json_encode(array(
            'status' => 'ok',
            'info'  =>  'comment deleted',
            'container' => null
        ));
    }

    function createComment($input){
        $this->obj = $this->obj->insertComment($input);
        return  json_encode(array('status'=>"ok",
        'info'=>"comment created",
        'container'=>null));
    }

    function listCommentsSearch($cve_cliente,$fecha,$id){
        $this->obj = $this->obj->getCommentsSearch($cve_cliente,$fecha,$id);
        if (count($this->obj) == 0) {
            return  json_encode(array(
                'status' => "not found",
                'info' => "Customers not found",
                'container' => []
            ));
        } else {
            return  json_encode(array(
                'status' => "ok",
                'info' => "Customers found",
                'container' => $this->obj
            ));
        }
    }
}
