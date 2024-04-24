<?php
session_start(); // Iniciar la sesión

include_once "config.php";

$currentUser = $_SESSION['unique_id'];

$sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id != '$currentUser'");
if(mysqli_num_rows($sql2) > 0){
    while($row = mysqli_fetch_assoc($sql2)){
        echo '
        <div class="overflow-auto h-4/5 user-card" data-user-id="'.$row['unique_id'].'">
        <div class="flex  mb-4 p-4 rounded">
            <img src="php/images/'.$row['img'].'" class="self-start rounded-full w-12 mr-4">
            <div class="w-full overflow-hidden">
                <div class="flex mb-1">
                    <p class="font-medium flex-grow">'.$row['fname'].' '.$row['lname'].'</p>
                    <small class="text-gray-500">09:55 am</small>
                </div>
                <small class="overflow-ellipsis overflow-hidden block whitespace-nowrap text-gray-500"> '.$row['status'].'</small>
            </div>
        </div>
    </div>
        ';
    }
} else {
    echo '<p>No hay usuarios disponibles.</p>';
}
?>
