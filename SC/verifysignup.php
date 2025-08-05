<?php  
    session_start();
    require "include/connect.php";
?>

<?php 
if (isset($_POST['sign'])) {
    $username = addslashes($_POST['username']);
    $raw_password = $_POST['password'];
    $raw_cpassword = $_POST['cpassword'];

    // Password match check
    if ($raw_password !== $raw_cpassword) {
        $_SESSION['msg3'] = "Passwords do not match!";
        header("Location: signup.php");
        exit();
    }

    // Password strength check (at least 8 characters, contains both letters and numbers)
    if (
        strlen($raw_password) < 5 ||
        !preg_match("/[a-zA-Z]/", $raw_password) ||
        !preg_match("/[0-9]/", $raw_password)
    ) {
        $_SESSION['msg3'] = "Password must be at least 5 characters long and contain both letters and numbers!";
        header("Location: signup.php");
        exit();
    }

    // Now hash the password AFTER all checks
    $hashed_password = sha1(md5($raw_password));

    // Check if username exists
    $checkuser = $db->query("SELECT * FROM users WHERE username='$username'") or die($db->error);
    $countuser = $checkuser->num_rows;

    if ($countuser == 0) {
        // Insert new user
        $insert = $db->query("INSERT INTO users (username, password) VALUES('$username', '$hashed_password')") or die($db->error);
        $_SESSION['msg1'] = "SUCCESSFUL";
        header("Location: index.php");
    } else {
        $_SESSION['msg3'] = "USERNAME ALREADY TAKEN";
        header("Location: signup.php");
    }
}
?>
