<?php

session_start();

include("connect.php");
error_reporting(0);


$_SESSION['username'] = $_POST['username'];

if ((!($_POST['username']) || !($_POST['password']))) {
 echo ' <body>
    <script type="text/javascript">
 window.parent.location.href = "index.html";
</script> </body>';

} else {
    $x = $_POST['username'];
  $test = oci_parse($conn, 'select USER_NAME
                      from   USERD
                      where  USER_NAME = :un_bv
                      and    PASSWORD = :pw_bv');
  oci_bind_by_name($test, ":un_bv", $_POST['username']);
  oci_bind_by_name($test, ":pw_bv", $_POST['password']);
  oci_execute($test);
  $r = oci_fetch_array($test, OCI_ASSOC);
  
if ($x=="admin" && $r)
{
    echo ' <body>
    <script type="text/javascript">
 window.parent.location.href = "admin.php";
</script> </body>';
}

elseif ($r) {
        echo ' <body>
    <script type="text/javascript">
 window.parent.location.href = "main.php";
</script> </body>';
  }
    
  else {
    // No rows matched so login failed
     echo ' <body> 
    <script type="text/javascript">
 alert("Incorrect login attempt, either your username does not exist or your password is incorrect. Please try again.");
 window.parent.location.href = "index.html";
</script> </body>';
  }
}

?> 