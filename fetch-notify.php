<?php
    session_start();
    include('connect.php');
    if(isset($_POST['view'])){
        $user = $_SESSION['id'];
        if($_POST["view"] != '') {
            $update_query = "UPDATE notifications SET noti_status = 1 WHERE noti_status = 0";
            mysqli_query($con, $update_query);
        }
        $query = "SELECT * FROM notifications WHERE noti_user = $user ORDER BY id DESC";
        $result = mysqli_query($con, $query);
        $output = '';

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
                $output .= '
                    <li style="">
                        <a href="#">
                            <strong>'.$row["noti_sub"].'</strong><br />
                            <small><em>'.$row["noti_mess"].'</em></small>
                        </a>
                    </li>
                ';
            }
        /*    $output .= '<div class="dropdown-divider"></div>
                        <li style="align-items: flex-end;"><a href="#">See more</a></li>';*/
        }
        else { 
            $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }

        $status_query = "SELECT * FROM notifications WHERE noti_status = 0 AND noti_user = $user";
        $result_query = mysqli_query($con, $status_query);
        $count = mysqli_num_rows($result_query);
        $output = '<li style="position: -webkit-sticky; position: sticky; top: 0px; background-color: white;"><a href="#"><small><em>'.$count.' new notification</em></small></a></li>'.$output;
        $data = array(
            'notification' => $output,
            'unseen_notification'  => $count
        );
        echo json_encode($data);
    }
?>