<?php

if (isset($_POST['login_button'])) {
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
    $_SESSION['log_email'] = $email; // store email into session variable

    $password = md5($_POST['log_password']); 

    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if ($check_login_query == 1) {
        $row = mysqli_fetch_array($check_database_query);
        $db_password = $row['password'];
        $username = $row['username'];

        $user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND user_closed='yes'");
        if(mysqli_num_rows($user_closed_query) == 1){
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
        }
        // Verify the password
        if ($password == $db_password) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            array_push($error_array, "Email or password was incorrect<br>");
        }
    } else {
        array_push($error_array, "Email or password was incorrect<br>");
    }
}
?>