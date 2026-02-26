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

    echo "<div class='alert alert-success'>File uploaded successfully!</div>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
    <title>Upload PDF or Image</title>
</head>
<body>
    
    <div class="container py-5">
        <div class = "row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                             <div class = "text-center">
                                 <i class="bi bi-rocket-takeoff-fill"></i><h2>Upload PDF or picture</h2>
                            </div>
                        <br>
                        <div class="input-group mb-3">
                        <form method="post" enctype="multipart/form-data">
                        <input type="file" class="form-control" name="file" required>
                        <br>
                        <div class = "d-flex gap-2 ">
                        <button type="submit" class="btn btn-primary w-50" name="upload">Upload</button>
                        <button type="button" class="btn btn-secondary w-50" onclick="window.location.href='view.php'">View Uploads</button>
                        <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>