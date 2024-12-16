<?php
require '../../Application/Comments/serviceComments.php';
class serviceCommentsController
{
    private $obj;

    function __construct() {
        $this->obj = new serviceComments();
    } 

    function listComments($fecha,$id)
    {
        $this->obj = $this->obj->getComments($fecha,$id);
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

    function listCommentsSearch($cve_cliente,$fecha,$id)
    {
        $this->obj = $this->obj->getCommentsSearch($cve_cliente,$fecha,$id);
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
}
