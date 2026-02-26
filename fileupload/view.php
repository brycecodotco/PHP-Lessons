<?php
include "connection.php";

$sql = "SELECT * FROM uploads";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    echo "<h3>" . $row['filename'] . "</h3>";

    //If PDF
    if($row['filetype'] == "application/pdf") {
        echo "<iframe src='data:application/pdf;base64," 
        .base64_encode($row['filedata']) . 
        "' width='500' height='300'></iframe>";
    }

    //If Image
    else{
        echo '<img src="data:' . $row['filetype'] . ';base64,'
        .base64_encode($row['filedata']) . '" width="300">';
    }
        echo "<hr>";
    }

?>