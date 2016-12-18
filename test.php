<?php
session_start();
include("connect.php");

$x_first = $_POST['first'];
$x_last = $_POST['last'];
$x_email = $_POST['email'];
$x_duser = $_POST['duser'];
$x_dpass = $_POST['dpass'];
$x_credit = $_POST['credit'];

$sql =  "INSERT INTO USERD VALUES (NULL,:bind_user,:bind_pass,:bind_first,:bind_last,:bind_credit,:bind_email)";

if (!($x_first) || (!$x_last) || (!$x_email) || (!$x_duser) || (!$x_dpass) || (!$x_credit))
{
    echo '<script type="text/javascript">alert("All fields are required for a user to register");
        location.href = "register.html";
        </script>';
}
else {
    $stid = oci_parse($conn, "SELECT USER_NAME FROM USERD WHERE USER_NAME = '$x_duser'");
    $r = oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC);
    if (!$row)
    {
    $stid2 = oci_parse($conn,$sql);
    oci_bind_by_name($stid2, ':bind_user',$x_duser);
    oci_bind_by_name($stid2, ':bind_pass',$x_dpass);
    oci_bind_by_name($stid2, ':bind_first',$x_first);
    oci_bind_by_name($stid2, ':bind_last',$x_last);
    oci_bind_by_name($stid2, ':bind_email',$x_email);
    oci_bind_by_name($stid2, ':bind_credit',$x_credit);
        oci_execute($stid2);
        echo'<script type="text/javascript">
        alert("Account has been created!");
         window.parent.location.href = "index.html";
        </script>';
    }
    else{
        echo'<script type="text/javascript">
        alert("The desired username already exists, Please select another");
         window.parent.location.href = "index.html";
        </script>';
    }
}

?>