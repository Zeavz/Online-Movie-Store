<?php

session_start();
include("connect.php");
include("adminmenu.php");
error_reporting(0);

echo '<br><h1>  Adding a Movie:  </h1> <h3> * Required Fields' ;
    echo '<h4>';
    echo '<form method="post" > <br>
     <b> * Movie Name: </b> 
        <input type="text" style="color:midnightblue" name="moviename" autocomplete=off  value=""> <br>  
    <b> * Actor Name: </b> 
        <input type="text" style="color:midnightblue" name="actorname" autocomplete=off  value=""> <br>  
     <b> * Director Name:  </b> 
     <input type="text" style="color:midnightblue" name="directorname" autocomplete=off  value=""> <br>  
     <b> * Producer Name: </b> 
        <input type="text" style="color:midnightblue" name="producername" autocomplete=off  value=""> <br>  
     <b>  * Year: </b> 
        <input type="number" style="color:midnightblue" name="movieyear" autocomplete=off  value=""> <br>  
<b> * Genre: </b> <select name="moviegenre" style="color:midnightblue"> 
  <option value="0" selected> ------------------- </option>
  <option value="Adventure">Adventure</option>
  <option value="Action">Action</option>
  <option value="Sci-Fi">Sci-Fi</option>     
  <option value="Drama">Drama</option>  
  <option value="Horror">Horror</option>
  <option value="Comedy">Comedy</option>
  <option value="Romance">Romance</option> 
    </select> <br>
     <b>  Rating: </b> 
        <input type="number" min="1" max="10" style="color:midnightblue" name="movierate" autocomplete=off  value=""> <br>
    <b>  Price: </b> 
        <input type="number" style="color:midnightblue" name="movieprice" autocomplete=off  value=""> <br>
     <b>  Length of Movie in Minutes: </b> 
        <input type="number" style="color:midnightblue" name="moviedur" autocomplete=off  value=""> 
         <b> * Released? </b> <select name="movierelease" style="color:midnightblue"> 
  <option value="0" selected> ------------------- </option>
   <option value=2>Yes</option>
   <option value=1>No</option>
    </select> <br>
            
   <br> <br>   <input type="submit" class="btn btn-info" role="button" name="finadd" value="Finish Adding Movie"> 
   </form> '; 

$finadd = ($_POST['finadd']);
$movie = ($_POST['moviename']);
$actor = ($_POST['actorname']);
$director = ($_POST['directorname']);
$producer = ($_POST['producername']);
$movieyear = ($_POST['movieyear']);
$moviegenre = ($_POST['moviegenre']);
$movierate = ($_POST['movierate']);
$movieprice = ($_POST['movieprice']);
$duration= ($_POST['moviedur']);
$release = ($_POST['movierelease']);     

echo "</h4>";

if ($finadd){
if ($movie && $director && $actor && $producer && $movieyear && $release && $moviegenre) 
{ 
    $stid = oci_parse($conn, "INSERT INTO MOVIES1 (movie_name,actors,directors,producers,release_date,genres,ratings,price,duration,released) VALUES ('$movie', '$actor', '$director', '$producer', '$movieyear', '$moviegenre', '$movierate', '$movieprice', '$duration', '$release')"); 
    oci_execute($stid); 
echo ' <script type="text/javascript">
 alert("The movie has been successfully added into the database.");
</script> ';

}

else 
{
    echo ' 
 <script type="text/javascript">
 alert("Looks like a required field is missing. Please fill in all required fields.");
</script> ';
    
}

}

?>