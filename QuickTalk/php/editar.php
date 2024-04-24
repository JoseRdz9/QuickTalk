<?php
    include("../php/conn-vistas.php");

    if (isset($_POST['guardar'])) {
        if(strlen($_POST['Enombre'])     >= 1
        && strlen($_POST['Eapellido_1']) >= 1
        && strlen($_POST['Etelefono'])   >= 1){
            $id = $_GET['id'];
            $nombre = trim($_POST['Enombre']);
            $apellido_1 = trim($_POST['Eapellido_1']);
            $telefono = trim($_POST['Etelefono']);
            $correo = trim($_POST['Ecorreo']);
            $encrypt_pass = md5($correo);
      
            $query = "UPDATE users set fname = '$nombre', lname = '$apellido_1', email = '$telefono', password = '$encrypt_pass' WHERE unique_id = '$id'";
            $resultado = mysqli_query($conn, $query);
            
            if($resultado){
                $_SESSION['mensaje'] = 'Actualizacion exitosa';
                $_SESSION['mensaje_tipo'] = 'success';
            }else{
                $_SESSION['mensaje'] = 'Actualizacion fallida';
                $_SESSION['mensaje_tipo'] = 'danger';
            }
            header('Location: /vista-admn.php');
        }
    }     
?>
