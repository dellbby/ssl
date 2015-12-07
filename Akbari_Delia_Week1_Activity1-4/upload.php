<!DOCTYPE html>
<html>
<head>
    <title>Activity1-4: Uploading File</title>
</head>
<body>

<?php
$uploaddir = './uploads/'; //physical path on Apache
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}
//print_r($_FILES);
?>
<br />

<img src= "<?php echo $uploadfile;?>" />
<p>File sent: <?php echo $_FILES['userfile']['name']; ?></p>


</body>
</html>