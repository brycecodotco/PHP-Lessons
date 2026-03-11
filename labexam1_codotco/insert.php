<?php
require 'config.php';

if(isset($_POST['add_patients'])) {
    $fullname = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contactnumber = $_POST['contact_number'];

    $stmt = $pdo->prepare("INSERT INTO patients(full_name, age, gender, contact_number) VALUES (?, ?, ?, ?)");
    $stmt->execute([$fullname, $age, $gender, $contactnumber]);

    echo "Patient added successfully!";
}

if(isset($_POST['add_consultation'])) {
    $patient_id = $_POST['patient_id'];  
    $doctorname = $_POST['doctor_name'];          
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];

    $stmt = $pdo->prepare("INSERT INTO consultations(patient_id, doctor_name, consultation_date, diagnosis, treatment) VALUES (?, ?, NOW(), ?, ?)");
    $stmt->execute([$patient_id, $doctorname, $diagnosis, $treatment]);

    echo "Consultation added successfully!";
}
?>