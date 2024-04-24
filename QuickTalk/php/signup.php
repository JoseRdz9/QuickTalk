<?php
session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$rol = isset($_POST['rol']) ? intval($_POST['rol']) : 0; // Aseguramos que 'rol' sea un entero y asignamos un valor por defecto si no está definido

// Importar clases PHPMailer
require "../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            $_SESSION['mensaje'] = "$email - ¡Este e-mail ya existe!";
            $_SESSION['mensaje_tipo'] = 'danger';
            header("Location: ../vista-admn.php"); // Cambiar index.php por la página donde quieres mostrar el mensaje
        } else {
            if (isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        $time = time();
                        $new_img_name = $time . $img_name;
                        if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                            $ran_id = rand(time(), 100000000);
                            $status = "Disponible";
                            $encrypt_pass = md5($password);
                            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, rol)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}', '{$rol}')");
                            if ($insert_query) {
                                // Envío de correo electrónico
                                $body = <<<HTML
                                    <h1>Bienvenido a QuickTalk ${fname} ${lname}</h1>
                                    <h2>Tu información</h2>
                                    <ul>
                                        <li>Nombre de usuario: ${fname} ${lname}</li>
                                        <li>Correo electrónico: ${email}</li>
                                        <li>Contraseña: ${password}</li>
                                    </ul>
                                HTML;

                                $mail = new PHPMailer(true);

                                $mail->isSMTP();
                                $mail->SMTPAuth = true;

                                $mail->Host = "smtp.gmail.com";
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;

                                $mail->Username = "quicktalk69@gmail.com";
                                $mail->Password = "dhsxzltusmsimsng";

                                $mail->setFrom("quicktalk69@gmail.com", "QuickTalk");
                                $mail->addAddress($email, $fname);

                                $mail->Subject = "Registro exitoso";
                                $mail->isHTML(true);
                                $mail->Body = $body;

                                try {
                                    $mail->send();
                                    $_SESSION['mensaje'] = 'Registro exitoso. Se ha enviado un correo electrónico de bienvenida.';
                                    $_SESSION['mensaje_tipo'] = 'success';
                                } catch (Exception $e) {
                                    $_SESSION['mensaje'] = 'Registro exitoso, pero no se pudo enviar el correo electrónico de bienvenida.';
                                    $_SESSION['mensaje_tipo'] = 'warning';
                                }
                            } else {
                                $_SESSION['mensaje'] = 'Algo salió mal. ¡Inténtalo de nuevo!';
                                $_SESSION['mensaje_tipo'] = 'danger';
                            }
                        }
                    } else {
                        $_SESSION['mensaje'] = 'Cargue un archivo de imagen: jpeg, png, jpg';
                        $_SESSION['mensaje_tipo'] = 'danger';
                    }
                } else {
                    $_SESSION['mensaje'] = 'Cargue un archivo de imagen: jpeg, png, jpg';
                    $_SESSION['mensaje_tipo'] = 'danger';
                }
            }
        }
    } else {
        $_SESSION['mensaje'] = "$email ¡No es un correo electrónico válido!";
        $_SESSION['mensaje_tipo'] = 'danger';
    }
} else {
    $_SESSION['mensaje'] = 'Todos los campos de entrada son obligatorios!';
    $_SESSION['mensaje_tipo'] = 'danger';
    
}
header("Location: ../vista-admn.php"); // Cambiar index.php por la página donde quieres mostrar el mensaje
?>
