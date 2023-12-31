<?php


include "objects.php";

// create new database
$db = new Database();

// 1. Test: create  student object $firstname,$lastname,$matrnr,$email,$pw
//$student = new Student("Angelina","Jolie",97658,"angelina.jolie@thws.de","jhgfaegzg76$");
//$student = new Student("Hale","Berry",57946,"hale.berry@thws.de","TZk6$");
$student = new Student("Till","Schweiger",64975,"till.schweiger@thws.de","jkbURdLI69&");
//write student to database if password ist valid (must contain at least one upper case letter and the length is at least 6)
if($student->pw_isvalid()){
    $db->writeStudentToDB($student);
}else{
    echo "Password is not valid!";
}
