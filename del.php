<?php

session_start();
include("connect.php");
include("adminmenu.php");
error_reporting(0);

 $stid = oci_parse($conn, "SELECT * FROM MOVIES1");
 oci_execute($stid);
 $row3 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 

echo '
<br><h1>  Removing a Movie:  </h1><br>'; 
      echo '<h4> '; 
    echo '<form method="post">
    <b> Movie: </b> 
    <select name="movie" id="mySelect2" onchange="myFunction2()"> 
 <option value="0" selected> ------------------- </option>'; 
 while ($row3 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) { 
 echo '
  <option value="'. $row3['MOVIEID'].'">' .$row3['MOVIE_NAME'], ' ('.$row3['RELEASE_DATE']. ') </option>'; }
echo '  
</select> <br> 
<script = "text/javascript"> 
function myFunction2() {
    var x = document.getElementById("mySelect2").value;
    location.href = ("del.php?item=" + x);
}
</script>';

$item = $_GET['item'];
$movie = ($_GET['movie']);
$test= 0;
echo '<br>';
    $stid = oci_parse($conn, "SELECT * FROM MOVIES1 WHERE movieid= '$item'"); 
  oci_execute($stid); 

while ($row3 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
          foreach ($row3 as $item) {
        if($item =='Everest') { echo'<img src="images/everest.jpg" alt="everest" height="270px"; width="183"> ';}
        if($item =='Jurassic World') { echo'<img src="images/jw.jpg" alt="jurassic" height="270px"; width="183"> ';}
        if($item =='Inception') { echo'<img src="images/in.jpg" alt="inception" height="270px"; width="183"> ';}
            if($item =='The Wolf of Wall Street') { echo'<img src="images/wolf.jpg" height="270px"; width="183"> ';}
         if($item =='Man of Steel') { echo'<img src="images/man.jpg" alt="manofsteel" height="270px"; width="183"> ';}
        if($item =='The Dark Knight') { echo'<img src="images/knight.jpg" alt="darkknight" height="270px"; width="183"> ';}
         if($item =='Interstellar') { echo'<img src="images/interstellar.jpg" alt="interstellar" height="270px"; width="183"> ';}
        if($item =='The Martian') { echo'<img src="images/martian.jpg" alt="interstellar" height="270px"; width="183"> ';}                
          }
     echo '<br><br><b> Movie ID: ' .$row3['MOVIEID'].'<br>';
     echo ' Movie: ' .$row3['MOVIE_NAME'].'<br>';
     echo 'Year: ' .$row3['RELEASE_DATE'].'<br>';
     echo 'Genre: ' .$row3['GENRES'] .'<br>';
     echo 'Rating: ' .$row3['RATINGS'] .'<br>';
     echo 'Price: $' .$row3['PRICE'] .'<br>';
     echo 'Actor: ' .$row3['ACTORS'].'<br>';
     echo 'Director: ' .$row3['DIRECTORS'] .'<br>';
     echo 'Producer: ' .$row3['PRODUCERS'].'<br>';
     echo 'Length of Movie: ' .$row3['DURATION'].' (mins) <br>';
     echo 'Released: '; 
     if($row3['RELEASED']==2){echo 'Yes';} 
     else {echo 'No';} 
    '<br>';
}

echo '
<br> <br> <br>  <button type="submit" class="btn btn-info"  name="findel" value="2"> Remove Movie </button>  <br> <br> <br>
   
    <input type="submit" class="btn btn-info" role="button" name="delall" value=" Remove MOVIES2 Table">  
   <p id="demo"></p> </form> ';


echo "</h4>";

$findel = ($_POST['findel']);
$delall = ($_POST['delall']);

$url = $_SERVER['REQUEST_URI'];
$id = substr($url,strrpos($url, '=')+1);

if ($findel)
{
  $stid = oci_parse($conn, "DELETE MOVIES1 WHERE movieid= '$id'");
  oci_execute($stid); 
  oci_commit($conn);
     echo ' <script type="text/javascript">
 alert("The movie has been successfully removed from the database.");
  window.parent.location.href = "del.php";
</script> ';
}

if ($delall){
    
  $stid = oci_parse($conn, "DROP TABLE MOVIES2"); 
    oci_execute($stid); 
echo ' <script type="text/javascript">
 alert("The second movie table has been dropped.");
 window.parent.location.href = "del.php";
</script> ';

}
    


?>