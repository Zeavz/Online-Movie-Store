<?php

session_start();
include("connect.php");
error_reporting(0);

?>

<!DOCTYPE html>
<html >

<head>
<title> WSR </title>
<meta charset="UTF-8">

<link href="icon.ico" rel="shortcut icon" type="image/x-icon">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    
</head>

<body>
    <div class=outterimage> 
    
           <form method="post" action="login.php" > <br> <br> 
            
           <b> Username: </b> 
           <input type="text"  name="username" style="color:midnightblue">
            <b> Password: </b> <input type="password"  name="password" style="color:midnightblue">
            <input type="submit" name="submit" class="btn btn-info" role="button" value="Log In" >
            <input type="button" id="register" name="register" class="btn btn-info" value="Register" onClick = "location.href = 'register.html'" />
          </form>
             
              
<iframe src="http://slideful.com/v20151112_1209125809064278_ijf.htm" frameborder="0" style="border:0px;padding:0px;margin:0px;width:1200px ; height:700px;" allowtransparency="true">
<a href="http://slideful.com/v20151112_1209125809064278_pf.htm">View the slide show</a></iframe>
    </div> ';
 
</body>
</html>
