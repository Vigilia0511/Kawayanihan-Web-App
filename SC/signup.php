<?php  
    session_start();
    require "include/connect.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KAWAYANIHAN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/style.css">
    <style>
        body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('img/kawa-back3.png') no-repeat center top;
        background-size: 100% auto;
        opacity: 0.08; /* Adjust transparency */
        z-index: -1;
}
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="verifysignup.php" class="login-form">
            <div class="login-box">
                <img src="img/KAWAYANIHAN.png" alt="Logo" class="logo-img">

                <div class="input-group">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-key icon"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>


                <div class="input-group">
                    <i class="fas fa-key icon"></i>
                    <input type="password" name="cpassword" placeholder="Confirm Password" required>
                </div>

                <button type="submit" id="sign" name="sign" class="login-button">Sign Up</button>

                <p class="signup-text">Already have an account? <a href="index.php">Login</a></p>

                <?php if(isset($_SESSION['msg3'])): ?>
                    <span class="message"><?php echo $_SESSION['msg3']; unset($_SESSION['msg3']); ?></span>
                <?php endif; ?>

                <?php if(isset($_SESSION['msg1'])): ?>
                    <span class="message1"><?php echo $_SESSION['msg1']; unset($_SESSION['msg1']); ?></span>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>
</html>
