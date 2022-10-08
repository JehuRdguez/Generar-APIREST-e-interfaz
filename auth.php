<?php 
require_once 'clases/auth.class.php';
require_once 'clases/response.class.php';

$_auth = new auth;
$_respuestas = new response;



if($_SERVER['REQUEST_METHOD'] == "POST"){
    $postData = $_POST;

    $dataArray = $_auth->logIn(json_encode($postData));
    
    $response = $dataArray['response'];
    $data = $dataArray['user'];
    if($response['status']== "ok"){
        session_start();
        $_SESSION['NombreCompleto'] = $data['Name'] . " " .$data['LastName'];
        $_SESSION['userType'] = $data['userType'];
        $_SESSION['userActive'] = $data['userActive'];
        echo "<script>confirm('$status');</script>";
        header("Location:/5TID1/Generar-APIREST-e-interfaz/views/users.php"); // 5TID1/APIREST -> APIREST_5TID1
    }else{
        echo "<script>alert('$response');</script>";
        header("Location:/5TID1/Generar-APIREST-e-interfaz/index.php"); // 5TID1/APIREST -> APIREST_5TID1

    }
}else{
    echo "Método no permitido";

}


?>