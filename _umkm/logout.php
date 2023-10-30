<?php
   session_start();
   unset($_SESSION['LAST_ACTIVITY']);
   unset($_SESSION['TIME_DURATION']);
   unset($_SESSION['ses_username']);
   unset($_SESSION['ses_nama']);
   unset($_SESSION['ses_hak']);
   unset($_SESSION['ses_id']);
   session_destroy();
   header("Location:index.php");
?>



