<?php
include 'config/config.php';

if ($pages[$_SESSION['currentPage']]['restricted'] && $_SESSION['currentPage'] != 'signin') {
    if (!isset($_SESSION['userID'])) {
      $_SESSION['returnPage'] = $_SESSION['currentPage'];
      header('Location: signin.php');
      exit();
    } 
}

//echo $_SESSION['returnPage'];
?>