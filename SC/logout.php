<?php
    session_start();
    require 'include/connect.php';

    session_destroy();
    header("Location: index.php");
?>