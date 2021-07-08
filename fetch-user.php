<?php
    session_start();
    include('connect.php');
    $output = '';
    $mess = '';
    if(isset($_SESSION['username'])) {
        $output .= '<i class="glyphicon glyphicon-user"> </i><span> '.$_SESSION['username'].'</span>';
        $mess .= '  <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span>
                    <span class="label label-pill label-success count" style="border-radius:10px;"></span>';

        $data = array(
            'username' => $output,
            'notifications' => $mess
        );
    }
    else {
        $data = array(
            'username' => $output,
            'notifications' => $mess
        );
    }
    echo json_encode($data);
?>
