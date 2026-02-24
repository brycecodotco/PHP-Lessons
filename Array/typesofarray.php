<?php
$fruits = array("Apple", "Banana", "Orange");

echo $fruits[0]; // Apple
echo "<br><br>";
echo $fruits[1]; // Banana
echo "<br><br>";


//Associative Array
$student = array(
    "name" => "Micheal",
    "age" => 21,
    "course" => "IT"
);

echo "Name: " . $student["name"] ."<br>";
echo "Age:". $student["age"] ."<br>";
echo "Course:". $student["course"] ."<br>";
echo "<br><br>";


//Multidimensional Array
$students = array(
    array("name" => "Michael", "age" => 21, "course"=> "IT"),
    array("name" => "Anna", "age" => 20, "course"=> "CS"),
    array("name" => "John", "age" => 22, "course" => "Math")
);

echo $students[0]["name"] ."<br>";
echo $students[1]["age"] ."<br>";
echo $students[2]["course"] ."<br>";
echo "<br><br>";

$text = "apple,banana,orange";

$fruits1 = explode(",", $text);
print_r($fruits1);
echo"<br><br>";

$fruits2 = ["apple", "banana", "orange"];
$text = implode(" - ", $fruits2);
echo $text;

?>
