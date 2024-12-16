<?php
require '../../Application/Comments/normalComments.php';
class normalCommentsController
{

    private $obj;

    function __construct() {
        $this->obj = new normalComments();
    } 

    function listComments($fecha, $cve)
    {
        $this->obj = $this->obj->getComments($fecha, $cve);
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

    function changeData($input)
    {
        $this->obj = $this->obj->updateComment($input);
        return  json_encode(array(
            'status' => "ok",
            'info' => "comment updated",
            'container' => $result
        ));
    }

    function deleteComment($id){
        $this->obj = $this->obj->deleteComment($id);
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

?>
