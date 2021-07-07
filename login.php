<?php
    session_start();
    if(isset($_POST['username'])) {
        include('connect.php');
        $username = mysqli_real_escape_string($con, $_POST["username"]);
        $password = mysqli_real_escape_string($con, $_POST["password"]);

        //$password = md5($password);

        $query = "SELECT id, user_username FROM users WHERE user_username = '$username' AND user_password like '$password'; ";
        $result = mysqli_query($con, $query);

        if($result) {
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row["id"];
                header('Location: notify.html');
            }
            else {
                echo "Login Unsuccessful";
            }
        }
        else {
            echo "Login Unsuccessful";
        }
    }
?>