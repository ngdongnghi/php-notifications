<?php
    session_start();
    include('connect.php');
    $output = '';
    $login = '<a href="login.html">Login</a>';
    $mess = '';
    if(isset($_SESSION['username'])) {
        $output .= '<i class="glyphicon glyphicon-user"> </i><span> '.$_SESSION['username'].'</span>';
        $mess .= '  <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span>
                    <span class="label label-pill label-success count" style="border-radius:10px;"></span>';
        $login = '';
        $data = array(
            'username' => $output,
            'notifications' => $mess,
            'login' => $login
        );
    }
    else {
        $data = array(
            'username' => $output,
            'notifications' => $mess,
            'login' => $login
        );
    }
    echo json_encode($data);
?>
