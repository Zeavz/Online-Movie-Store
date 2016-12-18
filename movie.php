<?php

session_start();
include("connect.php");
include("menu.php");
error_reporting(0);

$user  = $_SESSION['username'];
$id  = $_GET['item'];
$x = false ; 
$movieid;
$userid;

 $stid = oci_parse($conn, "SELECT * 
FROM  MOVIES1, USERD, TRANSACTIONS1, MPURCHASES 
WHERE MOVIES1.movieid = MPURCHASES.movieid AND USERD.user_name='$user' AND MOVIES1.movie_name= '$id' AND USERD.userid = MPURCHASES.userid AND TRANSACTIONS1.transactionid = MPURCHASES.transactionid  ORDER BY  transaction_date ASC"); 
  oci_execute($stid); 
$row3 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS) or $x = true;

 $stid2 = oci_parse($conn, "SELECT * FROM MOVIES1 WHERE movie_name= '$id' "); 
  oci_execute($stid2); 
$row4 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS);

if ($x && $row4 && $row4['RELEASED']==2) { 
    echo '<br>';
          foreach ($row4 as $item) {
        if($item =='Everest') { echo'<img src="images/everest.jpg" alt="everest" height="270px"; width="183"> ';}
        if($item =='Jurassic World') { echo'<img src="images/jw.jpg" alt="jurassic" height="270px"; width="183"> ';}
         if($item =='Inception') { echo'<img src="images/in.jpg" alt="inception" height="270px"; width="183"> ';}
            if($item =='The Wolf of Wall Street') { echo'<img src="images/wolf.jpg" height="270px"; width="183"> ';}
         if($item =='Man of Steel') { echo'<img src="images/man.jpg" alt="manofsteel" height="270px"; width="183"> ';}
        if($item =='The Dark Knight') { echo'<img src="images/knight.jpg" alt="darkknight" height="270px"; width="183"> ';}
         if($item =='Interstellar') { echo'<img src="images/interstellar.jpg" alt="interstellar" height="270px"; width="183"> ';}
            if($item =='The Martian') { echo'<img src="images/martian.jpg" alt="interstellar" height="270px"; width="183"> ';}   
                                    }
    
         echo '<br> <b>Movie: ' .$row4['MOVIE_NAME'].'<br>';
     echo 'Year: ' .$row4['RELEASE_DATE'].'<br>';
     echo 'Genre: ' .$row4['GENRES'] .'<br>';
     echo 'Rating: ' .$row4['RATINGS'] .'<br>';
     echo 'Price: $' .$row4['PRICE'] .'<br>';
     echo 'Actor: ' .$row4['ACTORS'].'<br>';
     echo 'Director: ' .$row4['DIRECTORS'] .'<br>';
     echo 'Producer: ' .$row4['PRODUCERS'].'<br>';
     echo 'Length of Movie: ' .$row4['DURATION'].' (mins) <br>';
    echo '<form method="post" >
           <input type="submit" class="btn btn-info" role="button" name="buy" value="Purchase Movie"> </form>';
         }

elseif ($x && $row4 && $row4['RELEASED']==1) { 

    echo '<br>';
     echo '<h3> This movie has not been released yet. </h3>';   
   foreach ($row4 as $item) {
        if($item =='Everest') { echo'<img src="images/everest.jpg" alt="everest" height="270px"; width="183"> ';}
        if($item =='Jurassic World') { echo'<img src="images/jw.jpg" alt="jurassic" height="270px"; width="183"> ';}
         if($item =='Inception') { echo'<img src="images/in.jpg" alt="inception" height="270px"; width="183"> ';}
            if($item =='The Wolf of Wall Street') { echo'<img src="images/wolf.jpg" height="270px"; width="183"> ';}
         if($item =='Man of Steel') { echo'<img src="images/man.jpg" alt="manofsteel" height="270px"; width="183"> ';}
        if($item =='The Dark Knight') { echo'<img src="images/knight.jpg" alt="darkknight" height="270px"; width="183"> ';}
         if($item =='Interstellar') { echo'<img src="images/interstellar.jpg" alt="interstellar" height="270px"; width="183"> ';}
            if($item =='The Martian') { echo'<img src="images/martian.jpg" alt="interstellar" height="270px"; width="183"> ';}   
    }
    echo '<br> <b>Movie: ' .$row4['MOVIE_NAME'].'<br>';
     echo 'Year: ' .$row4['RELEASE_DATE'].'<br>';
     echo 'Genre: ' .$row4['GENRES'] .'<br>';
     echo 'Actor: ' .$row4['ACTORS'].'<br>';
     echo 'Director: ' .$row4['DIRECTORS'] .'<br>';
     echo 'Producer: ' .$row4['PRODUCERS'].'<br>';
}
    
if ($row3) { 
    echo '<h3> You have already purchased this movie. 
    <br> This movie is in your account. </h3>';   
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
    echo '<br> <b>Movie: ' .$row4['MOVIE_NAME'].'<br>';
     echo 'Year: ' .$row4['RELEASE_DATE'].'<br>';
     echo 'Genre: ' .$row4['GENRES'] .'<br>';
     echo 'Actor: ' .$row4['ACTORS'].'<br>';
     echo 'Director: ' .$row4['DIRECTORS'] .'<br>';
     echo 'Producer: ' .$row4['PRODUCERS'].'<br>';
                 
}
    elseif(!(row3)) { echo '<h3> Movie Is Not Released Yet. </h3>';
    while ($row4 = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)){
          foreach ($row4 as $item) {
        if($item =='Everest') { echo'<img src="images/everest.jpg" alt="everest" height="270px"; width="183"> ';}
        if($item =='Jurassic World') { echo'<img src="images/jw.jpg" alt="jurassic" height="270px"; width="183"> ';}
         if($item =='Inception') { echo'<img src="images/in.jpg" alt="inception" height="270px"; width="183"> ';}
            if($item =='The Wolf of Wall Street') { echo'<img src="images/wolf.jpg" height="270px"; width="183"> ';}
         if($item =='Man of Steel') { echo'<img src="images/man.jpg" alt="manofsteel" height="270px"; width="183"> ';}
        if($item =='The Dark Knight') { echo'<img src="images/knight.jpg" alt="darkknight" height="270px"; width="183"> ';}
         if($item =='Interstellar') { echo'<img src="images/interstellar.jpg" alt="interstellar" height="270px"; width="183"> ';}
            if($item =='The Martian') { echo'<img src="images/martian.jpg" alt="interstellar" height="270px"; width="183"> ';}   
                                    }
    echo '<br> <b>Movie: ' .$row3['MOVIE_NAME'].'<br>';
     echo 'Year: ' .$row3['RELEASE_DATE'].'<br>';
     echo 'Genre: ' .$row3['GENRES'] .'<br>';
     echo 'Actor: ' .$row3['ACTORS'].'<br>';
     echo 'Director: ' .$row3['DIRECTORS'] .'<br>';
     echo 'Producer: ' .$row3['PRODUCERS'].'<br>';

         }}
    
    
$purchase = $_POST['buy'];
$date = date('d-M-Y');

if ($purchase) { 
    
     $stid = oci_parse($conn, "INSERT INTO MPURCHASES(MPURCHASES.movieid,MPURCHASES.userid) SELECT MOVIES1.movieid, USERD.userid FROM MOVIES1,USERD WHERE USERD.user_name= '$user' AND MOVIES1.movie_name='$id'"); 
    oci_execute($stid); 
   
    $stid2 = oci_parse($conn, "INSERT INTO TRANSACTIONS1(TRANSACTIONS1.transaction_date) VALUES('$date')"); 
    oci_execute($stid2); 
  
    $stid3 = oci_parse($conn, "UPDATE TRANSACTIONS1 SET TRANSACTIONS1.price = MOVIETRANSACTION.price FROM MOVIETRANSACTION WHERE TRANSACTIONS1.transactionid = MOVIETRANSACTION.transactionid"); 
    oci_execute($stid3); 
        
    echo '<script type="text/javascript">
 alert("This movie has been successfully purchased and added into your account.");
 window.parent.location.href = "account.php";
</script> }';

}


?>