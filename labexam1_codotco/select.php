<?php
require 'config.php';

$stmt = $pdo->query("SELECT * FROM patients");
$patients = $stmt->fetchall(PDO::FETCH_ASSOC);

$stmt2 = $pdo->query("SELECT consultations.consultation_id, patients.full_name AS patient_name, 
                    consultations.doctor_name, consultations.consultation_date, consultations.diagnosis, 
                    consultations.treatment FROM consultations 
                    INNER JOIN patients ON consultations.patient_id = patients.patient_id");
$consultations = $stmt2->fetchall(PDO::FETCH_ASSOC);

?>