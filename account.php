<?php
 
session_start();
include("connect.php");
include("menu.php");
error_reporting(0);

$user  = $_SESSION['username'];

echo '<br> <h1> ' .$user. '\'s  Movies:  </h1> <br><br>' ;

 $stid = oci_parse($conn, "SELECT movie_name FROM MUPLOADS WHERE user_name='$user'"); 
  oci_execute($stid);

echo '<div class="outterimage"> <table>';
while ($row3 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
       foreach ($row3 as $item) {
              echo '<td>';
        ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;");
     echo  '<h3>' .$item .  '<br>';
        if($item =='Everest') { echo'<img src="images/everest.jpg" alt="everest" height="270px"; width="183"> ';}
        if($item =='Jurassic World') { echo'<img src="images/jw.jpg" alt="jurassic" height="270px"; width="183"> ';}
         if($item =='Inception') { echo'<img src="images/in.jpg" alt="inception" height="270px"; width="183"> ';}
            if($item =='The Wolf of Wall Street') { echo'<img src="images/wolf.jpg" height="270px"; width="183"> ';}
         if($item =='Man of Steel') { echo'<img src="images/man.jpg" alt="manofsteel" height="270px"; width="183"> ';}
        if($item =='The Dark Knight') { echo'<img src="images/knight.jpg" alt="darkknight" height="270px"; width="183"> ';}
         if($item =='Interstellar') { echo'<img src="images/interstellar.jpg" alt="interstellar" height="270px"; width="183"> ';}
            if($item =='The Martian') { echo'<img src="images/martian.jpg" alt="interstellar" height="270px"; width="183"> ';}
      echo'<br><br>';
    }
}
echo '</div></table>';
?>