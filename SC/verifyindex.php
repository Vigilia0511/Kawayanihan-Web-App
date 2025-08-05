<?php  
    session_start();
    require "include/connect.php"
?>
<?php 
    if(isset($_POST['log'])){
        $username=addslashes($_POST['username']);
        $password=sha1(md5($_POST['password']));

        $checkuser=$db->query("SELECT * FROM users WHERE username='$username' AND password='$password'") or die($db-error);
        $countuser=$checkuser->num_rows;
        $fetcuser=$checkuser->fetch_assoc();

        if($countuser==0){
            $_SESSION['msg']="INVALID USERNAME";
            header("Location: index.php");
        }else{
            $_SESSION['msg1']="SUCSESSFUL";
            $_SESSION['user_id']= $fetcuser['user_id'];
            $_SESSION['username']= $fetcuser['username'];
            $_SESSION['role']= $fetcuser['role'];
            header("Location: dashboard.php");
        }
    }
?>
