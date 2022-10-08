<?php 

require_once '../clases/users.class.php';
require_once '../clases/response.class.php';
require_once '../clases/conexion/conexion.php';

$_user = new users;
$_respuestas = new response;


if($_SERVER['REQUEST_METHOD'] == "POST"){
    print_r($_POST);
    $postData = $_POST;
    
    $dataArray = $_user->postUser(json_encode($postData));

    if ($dataArray){
        header("Location:/5TID1/Generar-APIREST-e-interfaz/views/users.php"); 
    } else {
        return $_respuestas->err_500();
    }
}else if($_SERVER['REQUEST_METHOD'] == "GET"){
    $connect = new conexion;  
    $query = "SELECT * FROM userdata";
    $usuarios =  $connect->getData($query);

      for ($i=0; $i<count($usuarios);$i++){
        $listaUsuarios=$usuarios[$i];
  ?>
      <tr>
        <!--DATOS DE CELDAS-->
        <td><?php echo ($listaUsuarios["Name"]); ?></td>
        <td><?php echo ($listaUsuarios["Lastname"]);?></td>
        <td><?php echo ($listaUsuarios["RFC"]);?></td>
        <td><?php echo ($listaUsuarios["user"]);?></td>
        <td><?php echo ($listaUsuarios["userType"]);?></td>
        <td><?php if (($listaUsuarios["userActive"])==1){
            echo 'Activo';
        } else {
            echo 'Inactivo';
        }
        };?></td>
      </tr>

      <?php
}else{
    echo "Método no permitido";

}
?>