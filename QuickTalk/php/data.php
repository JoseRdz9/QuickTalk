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
                <div class="card mb-3 user-card" style="max-width: 540px;" data-user-id="'.$row['unique_id'].'">
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="php/images/'.$row['img'].'" class="img-fluid" alt="">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">'.$row['fname'].' '.$row['lname'].'</h5>
                            <p class="card-text">'.$row['status'].'</p>
                        </div>
                    </div>
                </div>
                </div>'
                ;
}
