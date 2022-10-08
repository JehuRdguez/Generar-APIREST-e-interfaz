<?php

require_once 'conexion/conexion.php';
require_once 'response.class.php';

class users extends conexion{

    private $nombre="";
    private $apellidos="";
    private $rfc="";
    private $nickName="";
    private $tipoUsuario="";

    /*
    public function consultaUsuarios($pagina = 1){
        $inicio = 0;
        $cantidadItems = 5;
        if ($pagina >1){
            $inicio = ($cantidadItems * ($pagina -1));
            $cantidadItems = $cantidadItems * $pagina;
        }
        $query = "SELECT * FROM userdata";
        $datos = parent::getData($query);
        return($datos);
    }*/

    public function insertarUsuario(){
        $query = "INSERT INTO personas (personName, personLastName, personRFC, bActive) VALUES 
        ('". $this->nombre . "', '". $this->apellidos ."', '". $this->rfc . "', 1);";
        $id = parent::postDataId($query);
        if($id){
            $query2 = "INSERT INTO users (personId, user, pass, userType, bActive) VALUES 
            ('". $id . "', '". $this->nickName ."', md5('". $this->nickName . "2022') , '".$this->tipoUsuario."',1);";
            $result = parent::postDataId($query2);
            return $result;
        } else {
            return 0;
        }
    }

    public function postUser($json){
        $_respuestas = new response;
        $datos = json_decode($json,true);
        $this->nombre = $datos['nw_userName'];
        $this->apellidos = $datos['nw_apellidos'];
        $this->rfc = $datos['nw_rfc'];
        $this->nickName = $datos['nw_nickName'];
        $this->tipoUsuario = $datos['userType'];

        $result = $this->insertarUsuario();

        if($result){
            $respuesta = $_respuestas->response;
            $respuesta["result"] = array("userId" => $result);
        }
    }
    



}

?>