<?php
    session_start();
    include('connect.php');
    if(isset($_POST['view'])){
        $user = $_SESSION['id'];

        $status_query1 = "SELECT * FROM notifications WHERE noti_status = 0 AND noti_user = $user";
        $result_query1 = $con->query($status_query1);
        $count1 = $result_query1->num_rows;

        if($_POST["view"] != '') {
            $update_query = "UPDATE notifications SET noti_status = 1 WHERE noti_status = 0";
            $con->query($update_query);
        }
    
        $output = '';

        $stmt = $con->prepare("SELECT * FROM notifications WHERE noti_user = ? ORDER BY id DESC");
        $stmt->bind_param("s", $user);
        $stmt->execute();

        $stmt->store_result();
        $stmt->bind_result($id, $sub, $mess, $status, $user);

        if($stmt->num_rows > 0) {
            while($stmt->fetch()) {
                $output .= '
                    <li>
                        <a href="#" id="'.$id.'" class="show-full-noti" (click)="load_full_mess()">
                            <strong>'.$sub.'</strong><br />
                            <small><em>'.substr($mess, 0, 35).'</em></small>
                        </a>
                    </li>
                ';
            }
        }
        else {
            $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
        }

        $status_query = "SELECT * FROM notifications WHERE noti_status = 0 AND noti_user = $user";
        $result_query = $con->query($status_query);
        $count = $result_query->num_rows;
        $output = '<li class="disabled" style="position: -webkit-sticky; position: sticky; top: 0px; background-color: white;">
                        <a href="#">
                            <small><em>'.$count1.' new notification</em></small>
                        </a>
                    </li>'.$output;
        $data = array(
            'notification' => $output,
            'unseen_notification'  => $count
        );
        echo json_encode($data);
    }
?>