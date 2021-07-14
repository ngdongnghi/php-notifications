<?php
    session_start();
    include('connect.php');

    $id = isset($_GET['id'])?(string)(int)$_GET['id']:false;
    
    $stmt = $con->prepare("SELECT noti_sub, noti_mess FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->store_result();
    $stmt->bind_result($sub, $mess);

    $output = '';

    if($stmt->num_rows > 0) {
        $stmt->fetch();
        $output .= '<p>Subject: '.$sub.'</p>
                    <p>Message: '.$mess.'</p>';
    }

    $data = array(
        'mess' => $output
    );

    echo json_encode($data);

?>