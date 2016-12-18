<?php

session_start();
include("connect.php");
include("menu.php");
error_reporting(0);

$test = 0;
$pics=0;
$pop = oci_parse($conn, 'SELECT movie_name FROM MOVIES1 WHERE purchases >1');
$soon = oci_parse($conn, 'SELECT movie_name FROM MOVIES1 WHERE released= 1');
oci_execute($pop);
oci_execute($soon);
    echo '<h1> Popular';
    echo '<table cellspace="100" !important>';

    while ($row = oci_fetch_array($pop, OCI_ASSOC+OCI_RETURN_NULLS)) {  
    foreach ($row as $item) {
        echo '<td>';
        ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;");
        echo "<h3><a href='movie.php?item=" . $item . "'>" 
         . $item .  '<br>';
        if($item =='Everest') { echo'<img src="images/everest.jpg" alt="everest" height="270px"; width="183"> ';}
        if($item =='Jurassic World') { echo'<img src="images/jw.jpg" alt="jurassic" height="270px"; width="183"> ';}
         if($item =='Inception') { echo'<img src="images/in.jpg" alt="inception" height="270px"; width="183"> ';}
            if($item =='The Wolf of Wall Street') { echo'<img src="images/wolf.jpg" height="270px"; width="183"> ';}
         if($item =='Man of Steel') { echo'<img src="images/man.jpg" alt="manofsteel" height="270px"; width="183"> ';}
        if($item =='The Dark Knight') { echo'<img src="images/knight.jpg" alt="darkknight" height="270px"; width="183"> ';}
         if($item =='Interstellar') { echo'<img src="images/interstellar.jpg" alt="interstellar" height="270px"; width="183"> ';}
            if($item =='The Martian') { echo'<img src="images/martian.jpg" alt="interstellar" height="270px"; width="183"> ';}   
    }
} echo '</table> </a>';
       echo '<h1> Coming Soon';
    echo '<table>';
while ($row2 = oci_fetch_array($soon, OCI_ASSOC+OCI_RETURN_NULLS)) {  
    foreach ($row2 as $item2) {
        echo '<td>';
        ($item2 !== null ? htmlentities($item2, ENT_QUOTES) : "&nbsp;");
 echo "<h3><a href='movie.php?item=" . $item2 . "'>" 
         . $item2 . '<br>';
        if($item2 =='Everest') { echo'<img src="images/everest.jpg" alt="everest" height="270px"; width="183"> ';}
        if($item2 =='Jurassic World') { echo'<img src="images/jw.jpg" alt="jurassic" height="270px"; width="183"> ';}
         if($item2 =='Inception') { echo'<img src="images/in.jpg" alt="inception" height="270px"; width="183"> ';}
            if($item2 =='The Wolf of Wall Street') { echo'<img src="images/wolf.jpg" height="270px"; width="183"> ';}
         if($item2 =='Man of Steel') { echo'<img src="images/man.jpg" alt="manofsteel" height="270px"; width="183"> ';}
        if($item2 =='The Dark Knight') { echo'<img src="images/knight.jpg" alt="darkknight" height="270px"; width="183"> ';}
         if($item2 =='Interstellar') { echo'<img src="images/interstellar.jpg" alt="interstellar" height="270px"; width="183"> ';}
            if($item2 =='The Martian') { echo'<img src="images/martian.jpg" alt="interstellar" height="270px"; width="183"> ';}   
    }
}
 echo '</table> </a>';


if(($_POST['logout'])) { // destroy the session 
session_destroy();
    echo '
    <script type="text/javascript">
 window.parent.location.href = "index.html";
</script>';  } 


echo'
    </body>
</html>';
?>