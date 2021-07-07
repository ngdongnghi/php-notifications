<?php
    if(isset($_POST["subject"])){
        include("connect.php");
        $user = mysqli_real_escape_string($con, $_POST["user"]);
        $subject = mysqli_real_escape_string($con, $_POST["subject"]);
        $comment = mysqli_real_escape_string($con, $_POST["message"]);
        $query = "INSERT INTO notifications(noti_sub, noti_mess, noti_user) VALUES ('$subject', '$comment', $user)";
    //    echo $query;
        mysqli_query($con, $query);
    }
?>