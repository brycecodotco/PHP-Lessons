<?php
require 'config.php';

if(isset($_GET['delete_patients'])){
    $patient_id = $_GET['delete_patients'];
    $stmt = $pdo->prepare("DELETE FROM patients WHERE patient_id = ?");
    $stmt->execute([$patient_id]);

    echo "Patient deleted successfully";
}

if(isset($_GET['delete_consultation'])){
    $consultation_id = $_GET['delete_consultation'];
    $stmt = $pdo->prepare("DELETE FROM consultations WHERE consultation_id = ?");
    $stmt->execute([$consultation_id]);

    echo "Consultation deleted successfully";
}
?>