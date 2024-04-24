<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No hay mensajes disponibles";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Tu: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Fuera de Línea") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    $output = '
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
    </div>';
}
