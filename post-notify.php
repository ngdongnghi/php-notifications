<!DOCTYPE html>
<html>
    <head>
        <title>Post Notification</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <br><br>
        <div class="container">
            <form method="post" id="notify_form">
                <div class="form-group">
                    <label>Enter Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control">
                </div>
                <div class="form-group">
                    <label>Enter Message</label>
                    <textarea name="message" id="message" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>User</label>
                    <select class="form-control" name="user" id="user" aria-label="Default select example">
                        <option selected>Select user</option>
                        <?php
                            include('connect.php');
                            $query = "SELECT * FROM users";
                            $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_array($result)) {
                                echo '<option value="'.$row["id"].'">'.$row['user_username'].'</option>';
                            }
                        ?>
                    </select>

                </div>
                <div class="form-group">
                    <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
                </div>
            </form>
        </div>


        <script>
            // submit form and get new records
            $('#notify_form').on('submit', function(event){
                event.preventDefault();
                if($('#subject').val() != '' && $('#message').val() != '' && $('#user').val() != ''){
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "insert.php",
                        method: "POST",
                        data: form_data,
                        success: function(data){
                            $('#notify_form')[0].reset();
                           // load_unseen_notification();
                           alert('Successfuly added a notification !')
                        }
                    });
                }
                else{
                    alert("Fields are Required");
                }
            });
        </script>
    <body>
</html>

