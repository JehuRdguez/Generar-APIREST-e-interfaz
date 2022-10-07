<?php 
if($_SERVER['REQUEST_METHOD'] == "POST"){
    print_r($_POST);
}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
    print_r($_GET);
}else{
    echo "Método no permitido";

}
?>