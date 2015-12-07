<?php
$schoolEmail = $_POST['school'];
$personalEmail = $_POST['personal'];
if(filter_var($personalEmail, FILTER_VALIDATE_EMAIL)){
    echo 'Valid Personal Email: ' . $personalEmail . "<br>";
}else{
    echo 'Invalid Personal Email: ' . $personalEmail . "<br>";
}
if(preg_match('/fullsail.edu/', $schoolEmail)){
    echo 'Valid School Email: ' . $schoolEmail . "<br>";
}else{
    echo 'Invalid School Email: ' . $schoolEmail . "<br>";
}  ?>