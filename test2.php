<?php

include "objects.php";

// create new database
$db = new Database();

//2. Test: Create a new Lectuerer
$lecturer = new Lecturer("Axl","Rose","sgslouguin!");
//$lecturer = new Lecturer("Taylor","Swift","Edj!");
//$lecturer = new Lecturer("Marshall","Mathers","lszCvfgeDgfg57!");
if($lecturer->pw_isvalid()){
    $db->writeLecturerToDB($lecturer);
}else{
    echo "Password is not valid!";
}


