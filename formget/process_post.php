<?php
if (isset($_POST["name"]) && isset($_POST["age"])) {
    $name = $_POST["name"];
    $age = $_POST["age"];

    echo"<h2>POST Data Received</h2>";
    echo "<p>Name: $name</p>";
    echo"<p>Age: $age</p>";
    echo"<p>Notice how the data is not visible in the URL!</p>";
}else {
    echo "No POST data Received";
}
?>