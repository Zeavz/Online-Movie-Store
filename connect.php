<?php 

// At Ryerson 
// Change from Host=141.117.57.159 to Host=oracle.scs.ryerson.ca in variable $db if Ryerson renews IP address. Note: Only Ryerson computers could access database after this change is made.

$db = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=141.117.57.159)(Port=1521))    (CONNECT_DATA=(SID=orcl)))';
$conn = oci_connect('jjesurat', '10198892', $db) or die("Not connecting at Ryerson");


// At Home. 
/*                                                        
$db = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=192.168.0.13)(Port=1521))(CONNECT_DATA=(SID=web)))';
$conn = oci_connect('BATMAN','Pista611', $db) or die("Not connecting at Home");
*/
                                                        
                                                        
?>