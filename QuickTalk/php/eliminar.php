<?php
    include("../php/conn-vistas.php");
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "DELETE FROM users WHERE unique_id = '$id'";
        $resultado = mysqli_query($conn, $query);

        if($resultado){
            $_SESSION['mensaje'] = 'Contacto eliminado';
            $_SESSION['mensaje_tipo'] = 'success';
        }else{
            $_SESSION['mensaje'] = 'Proceso fallido';
            $_SESSION['mensaje_tipo'] = 'danger';
        }
        header("Location: /vista-admn.php");
    }
?>