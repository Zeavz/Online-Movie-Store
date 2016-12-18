<?php

session_start();
include("connect.php");
include("menu.php");
error_reporting(0);

$user = ($_POST['username']) ;
$test = 0;
$all = ($_POST['all']);
$my = ($_POST['my']);
$genreTest = ($_POST['genres']);
$rateTest = ($_POST['rate']);
$yearTest = ($_POST['year']);
$priceTest = ($_POST['price']);
$searchTest = ($_POST['search']);
$ratecomp =  ($_POST['rv']);  
$yearcomp =  ($_POST['yv']);  
$pricecomp = ($_POST['pv']);
$logout = ($_POST['logout']);

if (($all)){
 $test = 1;
     echo '<br><h1> All Available Movies:  </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

if  (($my))
{ 
echo  '<script type="text/javascript">
 window.parent.location.href = "account.php?user="' . $user . '
</script>'; 
} 


elseif  (!($genreTest) && (!($rateTest)) && (!($yearTest)) && (!($searchTest)) && (!($priceTest)) && (!($all)) && (!($logout)))
{
    // If nothing is searched and search button is clicked
    echo  '<script type="text/javascript">
 window.parent.location.href = "main.php";
</script>'; 
}

elseif  (!($genreTest) && (!($rateTest)) && (!($yearTest)) && (($searchTest)) && (!($priceTest)) && (!($all)))
{
    // If only search filter is used
    $test = 1;
     echo '<br><h1> Search Movies Relating To: ' . $searchTest .  '</h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

elseif (($genreTest) && (!($rateTest)) && (!($yearTest)) && (!($priceTest)) && (!($searchTest))&& (!($all)))
{ 
    // only genre is used
    $test = 1;
    echo '<br><h1> Genre: ' . $genreTest .  '</h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND genres = '$genreTest'");
    $r=oci_execute($stid);
     $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
elseif  (!($genreTest) && (($rateTest)) && (!($yearTest)) && (!($priceTest)) && (!($searchTest)) && (!($all)))
{
        //only rating is set so search for rating
   $test = 1;
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND ratings $ratecomp $rateTest ");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
elseif  (!($genreTest) && (!($rateTest)) && (($yearTest)) && (!($priceTest)) && (!($searchTest)) && (!($all)))
{
        //only year is set so search for year
    $test = 1;
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND release_date $yearcomp $yearTest ");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
elseif  (!($genreTest) && (!($rateTest)) && (($priceTest)) && (!($yearTest)) && (!($searchTest)) && (!($all)))
{
        //only price is set so search for price
    $test = 1;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND price $pricecomp $priceTest ");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

elseif (($genreTest) && (!($rateTest)) && (!($yearTest)) && (($searchTest)) && (!($priceTest))&& (!($all)))
{
    // If only search filter and genre is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (!($genreTest) && (($rateTest)) && (!($yearTest)) && (($searchTest)) && (!($priceTest))&& (!($all)))
{
    // If only search filter and rating is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
      echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND ratings $ratecomp $rateTest");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (!($genreTest) && (!($rateTest)) && (($yearTest)) && (($searchTest)) && (!($priceTest))&& (!($all)))
{
    // If only search filter and year is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND release_date $yearcomp $yearTest");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (!($genreTest) && (!($rateTest)) && (!($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter and price is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif  (!($genreTest) && (!($rateTest)) && (($yearTest)) && (($priceTest)) && (!($searchTest))&& (!($all)))
{ 
       //searched price + year
        $test = 2; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND price $pricecomp $priceTest AND release_date $yearcomp $yearTest");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
    
elseif  (!($genreTest) && (($rateTest)) && (!($yearTest)) && (($priceTest)) && (!($searchTest))&& (!($all)))
{
       //searched price + rate
       $test = 2; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND ratings $ratecomp $rateTest AND price $pricecomp $priceTest");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

elseif  (($genreTest) && (!($rateTest)) && (!($yearTest)) && (($priceTest)) && (!($searchTest))&& (!($all)))
{
       //price + genre
    $test = 2;
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ; 
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND price $pricecomp $priceTest AND genres = '$genreTest'");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
elseif  (($genreTest) && (($rateTest)) && (!($yearTest)) && (!($priceTest)) && (!($searchTest))&& (!($all)))
{
       // genre + rate
    $test = 2;
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND ratings $ratecomp $rateTest AND genres = '$genreTest'");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
elseif  (($genreTest) && (!($rateTest)) && (($yearTest)) && (!($priceTest)) && (!($searchTest))&& (!($all)))
{
       // genre + year
         $test = 2;
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND release_date $yearcomp $yearTest AND genres = '$genreTest'");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

elseif  (!($genreTest) && (($rateTest)) && (($yearTest)) && (!($priceTest)) && (!($searchTest))&& (!($all)))
{
       // rating + year
        $test = 2; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND ratings $ratecomp $rateTest AND release_date $yearcomp $yearTest");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

elseif (!($genreTest) && (!($rateTest)) && (($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter,year,price is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest AND release_date $yearcomp $yearTest");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (!($genreTest) && (($rateTest)) && (!($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter,price,rating is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest AND ratings $ratecomp $rateTest");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (($genreTest) && (!($rateTest)) && (!($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter,price,genre is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
      echo '<h1>  Genre: ' .$genreTest . '</h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (($genreTest) && (($rateTest)) && (!($yearTest)) && (($searchTest)) && (!($priceTest))&& (!($all)))
{
    // If only search filter,rating,genre is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ;
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND ratings $ratecomp $rateTest AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (($genreTest) && (!($rateTest)) && (($yearTest)) && (($searchTest)) && (!($priceTest))&& (!($all)))
{
    // If only search filter,year,genre is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ;
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND release_date $yearcomp $yearTest AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (!($genreTest) && (($rateTest)) && (($yearTest)) && (($searchTest)) && (!($priceTest))&& (!($all)))
{
    // If only search filter,year,ratings is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND release_date $yearcomp $yearTest AND ratings $ratecomp $rateTest");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif  (($genreTest) && (($rateTest)) && (($yearTest)) && (!($priceTest)) && (!($searchTest))&& (!($all)))
{
       // genre + rating  + year
      $test = 2; 
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND genres='$genreTest' AND ratings $ratecomp $rateTest AND release_date $yearcomp $yearTest");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
elseif  (($genreTest) && (($rateTest)) && (!($yearTest)) && (($priceTest)) && (!($searchTest))&& (!($all)))
{
       // genre + rating  + price
            $test = 2; 
     echo '<h1>  Genre: ' .$genreTest . '</h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND genres='$genreTest' AND ratings $ratecomp $rateTest AND price $pricecomp $priceTest");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}
elseif  (!($genreTest) && (($rateTest)) && (($yearTest)) && (($priceTest)) && (!($searchTest))&& (!($all)))
{
       // year + rating + price
              $test = 2; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND price $pricecomp $priceTest AND ratings $ratecomp $rateTest AND release_date $yearcomp $yearTest");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

elseif (($genreTest) && (($rateTest)) && (($yearTest)) && (($searchTest)) && (!($priceTest))&& (!($all)))
{
    // If only search filter, genre,ratings,year is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Genre: ' .$genreTest .' </h1>' ; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND release_date $yearcomp $yearTest AND ratings $ratecomp $rateTest AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (($genreTest) && (($rateTest)) && (!($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter, genre,ratings,price is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Genre: ' .$genreTest .' </h1>' ; 
    echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest AND ratings $ratecomp $rateTest AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif (($genreTest) && (!($rateTest)) && (($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter, genre,year,price is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Genre: ' .$genreTest .' </h1>' ; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest AND release_date $yearcomp $yearTest AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}


elseif (!($genreTest) && (($rateTest)) && (($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter, year,ratings,price is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest AND ratings $ratecomp $rateTest AND release_date $yearcomp $yearTest");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

elseif  (($genreTest) && (($rateTest)) && (($yearTest)) && (($priceTest)) && (!($searchTest))&& (!($all)))
{
       // genre + rating + price + year
          $test = 2; 
     echo '<h1>  Genre: ' .$genreTest .' </h1>' ; 
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND price $pricecomp $priceTest AND ratings $ratecomp $rateTest AND release_date $yearcomp $yearTest AND genres='$genreTest'");
    oci_execute($stid) ;
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("Sorry, we do not have a movie in the category you searched with. Movies in this search criteria do not exist on this website or has not been released yet."); 
}

elseif (($genreTest) && (($rateTest)) && (($yearTest)) && (($searchTest)) && (($priceTest))&& (!($all)))
{
    // If only search filter, year,ratings,price is used
    $test = 2;
     echo '<br><h1> Specific Search Relating To: ' . $searchTest .  '</h1>' ;
     echo '<h1>  Year ' .$yearcomp .' ' . $yearTest . ' </h1>' ; 
     echo '<h1>  Genre: ' .$genreTest .' </h1>' ; 
     echo '<h1>  Rating ' .$ratecomp .' ' . $rateTest . ' </h1>' ;
     echo '<h1>  Price ' .$pricecomp .' $' . $priceTest . ' </h1>' ; 
    $stid = oci_parse($conn, "SELECT movie_name FROM MOVIES1 WHERE released=2 AND (movie_name= '$searchTest' OR directors= '$searchTest' OR producers= '$searchTest' OR actors= '$searchTest') AND price $pricecomp $priceTest AND ratings $ratecomp $rateTest AND release_date $yearcomp $yearTest AND genres='$genreTest'");
    oci_execute($stid);
    $r = oci_execute($stid); 
    $row2 = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)or die("We could not find the movie you specifically searched for.Your specific search was not accurate. Perhaps you should try searching only using the search filter."); 
}

echo'<table>';
if ($test = 1)
{ 
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
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
      echo'<br><br>';
    }
    echo "</td> </a>";
}
}

if ($test = 2)
{
    foreach ($row2 as $item) {
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
      echo'<br><br>';
    }
    echo "</td> ";
}
echo '</table></a>';


if($logout) { // destroy the session 
echo '
    <script type="text/javascript">
 window.parent.location.href = "index.html";
</script>';  } 

echo'
    </body>
</html>';
?>