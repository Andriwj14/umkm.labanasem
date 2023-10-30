<?php
   session_start();
   session_unset($_SESSION['LAST_ACTIVITY']);
   session_unset($_SESSION['TIME_DURATION']);
   session_unset($_SESSION['ses_username']);
   session_unset($_SESSION['ses_nama']);
   session_unset($_SESSION['ses_hak']);
   session_unset($_SESSION['ses_id']);
   session_destroy();
   header("Location:index.php");
?>



