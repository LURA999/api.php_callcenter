<?php
require '../../Application/Comments/commentAgreements.php';
class commentsAgreementsController
{
    private $obj;

    function __construct() {
        $this->obj = new commentAgreements();
    } 

    function listComments($fecha, $cve, $opc)
    {
        $this->obj = $this->obj->getComments($fecha, $cve, $opc);
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

    function changeData($input)
    {
        $this->obj = $this->obj->updateComment($input);
       return  json_encode(array(
            'status' => "ok",
            'info' => "comment updated",
            'container' => $result
        ));
    }
    
    function changeDataStatus( $input){
        $this->obj = $this->obj->updateDateStatus($input);
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

    function listCommentsSearch($cve_cliente,$fecha,$id,$opc){
        $this->obj = $this->obj->getCommentsSearch($cve_cliente,$fecha,$id,$opc);
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