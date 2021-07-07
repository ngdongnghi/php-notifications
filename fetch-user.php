<?php
    session_start();
    include('connect.php');
    $output = '';
    $info = '';
    if(isset($_SESSION['username'])) {
        $output .= '<i class="glyphicon glyphicon-user"> </i><span> '.$_SESSION['username'].'</span>';
        $info .= '<li><a href="logout.php">Logout</a></li>';
        $data = array(
            'username' => $output
        );
    }
    else {

        $data = array(
            'username' => $output
        );
    }
    echo json_encode($data);
?>
