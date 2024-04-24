<?php

session_start();

if(!isset($_SESSION['txtusuario'])) {
    header("location: ../../index.php");
    exit();
}

?>
