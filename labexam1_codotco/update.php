<?php
require 'config.php';

if (isset($_POST['update_patients'])) {
    $patient_id = $_POST['patient_id'];
    $fullname = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];

    $stmt = $pdo->prepare("UPDATE patients SET full_name = ?, age = ?, gender = ?, contact_number = ? WHERE patient_id = ?");
    $stmt->execute([$fullname, $age, $gender, $contact_number, $patient_id]);

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

if (isset($_POST['update_consultation'])) {
    $consultation_id = $_POST['consultation_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_name = $_POST['doctor_name'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];

    $stmt = $pdo->prepare("UPDATE consultations SET patient_id = ?, doctor_name = ?, diagnosis = ?, treatment = ? WHERE consultation_id = ?");
    $stmt->execute([$patient_id, $doctor_name, $diagnosis, $treatment, $consultation_id]);

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}
?>