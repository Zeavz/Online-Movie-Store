<?php

include("connect.php");
error_reporting(0);


echo '
<html>

<head>
<title> WSR </title>
<meta charset="UTF-8">

<link href="icon.ico" rel="shortcut icon" type="image/x-icon">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>

<body style="font-family:verdana,arial,helvetica;;font-size:11pt;">
<div class=outterimage> 
 <img src="logo%20copy3.png" alt="logo" height="180px"> </div> 
    <div class=menu2>
    <form method="post" action="search.php" > <br> <br>
        <b> Search Filter </b> 
        <input type="text" style="color:midnightblue" name="search" autocomplete=off  value="">  
      <input type="submit" class="btn btn-info" role="button" value="Search">
      <input type="submit" class="btn btn-info" role="button" name="all" value="Show All Available Movies" > 
      <input type="submit" class="btn btn-info" role="button" name="my" value="My Movies" > 
      <input type = "submit" class="btn btn-info" role="button" value="Log Out" name="logout"> <br> <br>
        <b> Genres: </b> <select name="genres" style="color:midnightblue"> 
  <option value="0" selected> ------------------- </option>
  <option value="Adventure">Adventure</option>
  <option value="Action">Action</option>
  <option value="Sci-Fi">Sci-Fi</option>     
 <option value="Drama">Drama</option> 
   <option value="Horror">Horror</option>
  <option value="Comedy">Comedy</option>
  <option value="Romance">Romance</option> 
    </select>
    <b> Ratings: </b> <select name="rate" style="color:midnightblue"> 
  <option value="0" selected> ------------------- </option>
  <option value=1>1</option>
  <option value=2>2</option>
  <option value=3>3</option>
  <option value=4>4</option>
  <option value=5>5</option>
  <option value=6>6</option>
  <option value=7>7</option>     
  <option value=8>8</option>
  <option value=9>9</option> 
  <option value=10>10</option>
    </select>
  <select name="rv" style="color:midnightblue"> 
  <option value="="> Equal To </option>
  <option value="<">Less Than</option>
  <option value="<=">Less Than or Equal To</option>
  <option value=">">Greater Than</option>  
  <option value=">=">Greater Than or Equal To</option>     
    </select> <br> <br>
     <b> Year: </b> <select name="year" style="color:midnightblue"> 
  <option value="0" selected> ------------------- </option>
  <option value=2010>2010</option>
 <option value=2011>2011</option>
  <option value=2012>2012</option>
  <option value=2013>2013</option>     
 <option value=2014>2014</option>
        <option value="2015">2015</option> 
    </select> 
      <select name="yv" style="color:midnightblue"> 
  <option value="="> Equal To </option>
  <option value="<">Less Than</option>
  <option value="<=">Less Than or Equal To</option>
  <option value=">">Greater Than</option>  
  <option value=">=">Greater Than or Equal To</option>     
    </select>
     <b> Price: </b> <select name="price" style="color:midnightblue"> 
     <option value="0" selected> ------------------- </option>
  <option value=5>$5</option>
 <option value=10>$10</option>
  <option value=15>$15</option>
  <option value=20>$20</option>     
 <option value=25>$25</option>
  <option value=30>$30</option>
    </select> 
      <select name="pv" style="color:midnightblue"> 
  <option value="="> Equal To </option>
  <option value="<">Less Than</option>
  <option value="<=">Less Than or Equal To</option>
  <option value=">">Greater Than</option>  
  <option value=">=">Greater Than or Equal To</option>     
    </select>
    </form> <br>
        </div>
    ';
?>