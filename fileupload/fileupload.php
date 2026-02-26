<?php
include "connection.php";

if(isset($_POST['upload'])) {
    $filename = $_FILES['file']['name'];
    $filetype = $_FILES['file']['type'];
    $tempname = $_FILES['file']['tmp_name'];

    //Get file content
    $filedata = addslashes(file_get_contents($tempname));


    //Insert file into database
    $sql = "INSERT INTO uploads (filename, filetype, filedata) 
    VALUES ('$filename', '$filetype', '$filedata')";

    mysqli_query($conn, $sql);

    echo "File uploaded successfully!";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF or Image</title>
</head>
<body>
    <h2>Upload PDF or picture</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file"  required>
        <br><br>
        <button type="submit" name="upload">Upload</button>
</body>
</html>