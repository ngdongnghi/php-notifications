<?php
    session_start();
    if(isset($_POST['username'])) {
        include('connect.php');
        $username = $con->real_escape_string($_POST["username"]);
        $password = $con->real_escape_string($_POST["password"]);

        //$password = md5($password);

    //    $query = "SELECT id, user_username FROM users WHERE user_username = '$username' AND user_password like '$password'; ";
    //    $result = mysqli_query($con, $query);
        $stmt = $con->prepare("SELECT id, user_username FROM users WHERE user_username = ? AND user_password = ?");
        
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $stmt->store_result();
        $stmt->bind_result($id, $user);
        
        $result = $stmt->fetch();
        
        if($stmt) {
            if($stmt->num_rows == 1) {
            //   echo $user;
                $_SESSION['username'] = $user;
                $_SESSION['id'] = $id;
                header('Location: index.html');
            }
            else {
                echo "<script>alert('Login Unsuccessful')</script>";
            }
        }
        else {
            echo "<script>alert('Login Unsuccessful')</script>";
        }
    }
?>