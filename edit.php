<?php

session_start();
include("connect.php");
include("adminmenu.php");
 error_reporting(0);

 $stid = oci_parse($conn, "SELECT * FROM MOVIES1");
 oci_execute($stid);
 $row3 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 

echo '<br><h1>  Editing a Movie:  </h1><br>';
    echo '<h4> <form method ="post">'; 
    echo '<b> Movie: </b> 
    <select name="movie" id="mySelect2" onchange="myFunction2()">
     <option value="" selected> ------------------- </option>';
 while ($row3 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) { 
echo '<option value="'. $row3['MOVIEID'].'">' .$row3['MOVIE_NAME'], ' ('.$row3['RELEASE_DATE']. ') </option>'; }
echo '</select> </form> 
<p id="demo"></p>

<script = "text/javascript"> 
function myFunction2() {
    var x = document.getElementById("mySelect2").value;
    window.parent.location.href = ("edit.php?item=" + x);
}
</script>';

$item = $_GET['item'];

if ($item) { 
    $stid = oci_parse($conn, "SELECT * FROM MOVIES1 WHERE movieid= '$item'"); 
  oci_execute($stid); 
    $movieid ;
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
    $movieid = $row3['MOVIEID'] ;
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
    echo ' <br> <br> <form method ="post">
     <b> Change Movie Name: </b> 
        <input type="text" style="color:midnightblue" name="moviename" autocomplete=off  value=""> <br>  
     <b> Change Year: </b> 
        <input type="number" style="color:midnightblue" name="movieyear" autocomplete=off  value=""> <br>  
<b> Change Genre: </b> <select name="moviegenre" style="color:midnightblue"> 
  <option value="0" selected> ------------------- </option>
  <option value="Adventure">Adventure</option>
  <option value="Action">Action</option>
  <option value="Sci-Fi">Sci-Fi</option>     
  <option value="Drama">Drama</option>  
  <option value="Horror">Horror</option>
  <option value="Comedy">Comedy</option>
  <option value="Romance">Romance</option> 
    </select> <br>
     <b>  Change Rating: </b> 
        <input type="number" min="1" max="10" style="color:midnightblue" name="movierate" autocomplete=off  value=""> <br>
    <b>  Change Price: </b> 
        <input type="number" style="color:midnightblue" name="movieprice" autocomplete=off  value=""> <br>
        <b> Change Actor Name: </b> 
        <input type="text" style="color:midnightblue" name="actorname" autocomplete=off  value=""> <br>  
     <b> Change Director Name:  </b> 
     <input type="text" style="color:midnightblue" name="directorname" autocomplete=off  value=""> <br>  
     <b> Change Producer Name: </b> 
        <input type="text" style="color:midnightblue" name="producername" autocomplete=off  value=""> <br>  
     <b> Change Duration: </b> 
        <input type="number" style="color:midnightblue" name="moviedur" autocomplete=off  value=""> <br>
         <b> Change Release </b> <select name="movierelease" style="color:midnightblue"> 
  <option value="0" selected> ------------------- </option>
 <option value=2>Yes</option>
    <option value=1>No</option>
    </select> <br>
            
  <br><input type="submit" class="btn btn-info" role="button" name="fined" value="Finish Editing Movie Information"> 
   </form>  '; 
}
  }  

    
$fined = ($_POST['fined']);
$name = ($_POST['moviename']);
$actor = ($_POST['actorname']);
$director = ($_POST['directorname']);
$producer = ($_POST['producername']);
$year = ($_POST['movieyear']);
$genre = ($_POST['moviegenre']);
$rate = ($_POST['movierate']);
$price = ($_POST['movieprice']);
$duration= ($_POST['moviedur']);
$release = ($_POST['movierelease']);   

$url = $_SERVER['REQUEST_URI'];
$id = substr($url,strrpos($url, '=')+1);

if ($fined) {
   
    if ($name) 
    {
     $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET movie_name = '$name' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
    
    if($year)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET release_date = '$year' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
        if($genre)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET genres = '$genre' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
    
            if($rate)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET ratings = '$rate' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
            if($price)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET price = '$price' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
           if($actor)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET actors = '$actor' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
           if($director)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET directors = '$director' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
               if($producer)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET producers = '$producer' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
                 if($duration)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET duration = '$duration' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
                 if($release)
    {
    $stid2 = oci_parse($conn, "UPDATE MOVIES1 SET released = '$release' WHERE movieid = '$id'");
     $r = oci_execute($stid2);
     $s = oci_commit($conn); 
    }
    
    echo ' <script type="text/javascript">
 alert("This movies information has been successfully edited.");
  window.parent.location.href = "edit.php";
</script> '; 
}

?>