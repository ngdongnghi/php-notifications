<?php
    if(isset($_POST["subject"])){
        include("connect.php");
        
        $user = $con->real_escape_string($_POST["user"]);
        $subject = $con->real_escape_string($_POST["subject"]);
        $message = $con->real_escape_string($_POST["message"]);
    
        $stmt = $con->prepare("INSERT INTO notifications(noti_sub, noti_mess, noti_user) VALUES (?,?,?)");
        $stmt->bind_param("ssi", $subject, $message, $user);
        $stmt->execute();
    }
?>