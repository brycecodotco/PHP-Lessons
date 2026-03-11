<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';
?>


<?php
// Edit Mode
$editpatient = null;
$editconsultation = null;

if (isset($_GET['edit_patient'])) {
    $patient_id = $_GET['edit_patient'];
    $stmt = $pdo->prepare("SELECT * FROM patients WHERE patient_id = ?");
    $stmt->execute([$patient_id]);
    $editpatient = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET["edit_consultation"])) {
    $consultation_id = $_GET["edit_consultation"];
    $stmt = $pdo->prepare("SELECT * FROM consultations WHERE consultation_id = ?");
    $stmt->execute([$consultation_id]);
    $editconsultation = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Hospital Manager</h1>
        <ul class="nav nav-tabs mb-4" id="navtabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="patients-tab" data-bs-toggle="tab" data-bs-target="#patients"
                    type="button" role="tab" aria-controls="patients" aria-selected="true">Patients</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="consultations-tab" data-bs-toggle="tab" data-bs-target="#consultations"
                    type="button" role="tab" aria-controls="consultations" aria-selected="false">Consultations</button>
            </li>
        </ul>
    </div>


    <!-- Patients Tab -->
    <div class="tab-content">
        <div id="patients" class="tab-pane fade show active">
            <div class="container mb-5">
                <div class="row mb-4 mt-5" id="patients">
                    <div class="col-12">
                        <div class="card shadow <?= $editpatient ? 'border-warning' : '' ?>">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0"><?= $editpatient ? 'Update Patient Details' : 'Add Patient' ?></h4>
                                <?php if ($editpatient): ?>
                                    <a href="?" class="btn btn-sm btn-light">Cancel Edit</a>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <form method="POST" class="row g-3">
                                    <?php if ($editpatient): ?>
                                        <input type="hidden" name="patient_id" value="<?= $editpatient['patient_id'] ?>">
                                    <?php endif; ?>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Full Name</label>
                                        <input type="text" class="form-control" name="full_name"
                                            value="<?= $editpatient['full_name'] ?? '' ?>" placeholder="Enter full name"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Age</label>
                                        <input type="text" class="form-control" name="age"
                                            value="<?= $editpatient['last_name'] ?? '' ?>" placeholder="Enter age"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Gender</label>
                                        <input type="tel" class="form-control" name="gender"
                                            value="<?= $editpatient['gender'] ?? '' ?>" placeholder="Enter gender"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Contact Number</label>
                                        <input type="tel" class="form-control" name="contact_number"
                                            value="<?= $editpatient['contact_number'] ?? '' ?>"
                                            placeholder="Enter contact number" required>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            name="<?= $editpatient ? 'update_patients' : 'add_patients' ?>"
                                            class="btn <?= $editpatient ? 'btn-warning' : 'btn-success' ?>">
                                            <?= $editpatient ? 'Update Patient' : 'Add Patient' ?>
                                        </button>
                                    </div>
                                </form>
                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Patient Name</th>
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    <th>Contact Number</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($patients as $patient): ?>
                                                    <tr class="<?= ($editpatient && $editpatient['patient_id'] == $patient['patient_id']) ? 'table-warning' : '' ?>">
                                                         <td>
                                                            <?= $patient['patient_id'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $patient['full_name'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $patient['age'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $patient['gender'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $patient['contact_number'] ?>
                                                        </td>
                                                        <td>
                                                            <a href="?edit_patient=<?= $patient['patient_id'] ?>"
                                                                class="btn btn-sm btn-warning">Edit</a>
                                                            <a href="?delete_patients=<?= $patient['patient_id'] ?>"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Consultations Tab -->
        <div id="consultations" class="tab-pane fade">
            <div class="tab-content">
                    <div class="container mb-5">
                        <div class="row mb-4 mt-5" id="consultations">
                            <div class="col-12">
                                <div class="card shadow <?= $editconsultation ? 'border-warning' : '' ?>">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4 class="mb-0"><?= $editconsultation ? 'Update Consultation' : 'Record New Consultation' ?>
                                        </h4>
                                        <?php if ($editconsultation): ?>
                                            <a href="?" class="btn btn-sm btn-light">Cancel Edit</a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="" class="row g-3">
                            <?php if ($editconsultation): ?>
                                <input type="hidden" name="consultation_id" value="<?= $editorder['consultation_id'] ?>">
                            <?php endif; ?>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Patient</label>
                                <select class="form-select" name="patient_id" required>
                                    <option value="">Select Patient</option>
                                    <?php foreach ($patients as $patient): ?>
                                        <option value="<?= $patient['patient_id'] ?>" 
                                            <?= ($editconsultation && $editconsultation['patient_id'] == $patient['patient_id']) ? 'selected' : '' ?>>
                                            <?= $patient['full_name'] . ' ' . $patient['age'] . ' ' . $patient['gender'] . ' '. '(' . $patient['contact_number'] . ')' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                           <div class="col-md-3">
                                        <label class="form-label fw-bold">Doctor Name</label>
                                        <input type="tel" class="form-control" name="doctor_name"
                                            value="<?= $editconsultation['doctor_name'] ?? '' ?>"
                                            placeholder="Enter the name of the doctor" required>
                            </div>
                            <div class="col-md-3">
                                        <label class="form-label fw-bold">Diagnosis</label>
                                        <input type="tel" class="form-control" name="diagnosis"
                                            value="<?= $editconsultation['diagnosis'] ?? '' ?>"
                                            placeholder=" " required>
                            </div>
                            <div class="col-md-3">
                                        <label class="form-label fw-bold">Treatment</label>
                                        <input type="tel" class="form-control" name="treatment"
                                            value="<?= $editconsultation['treatment'] ?? '' ?>"
                                            placeholder=" " required>
                            </div>
                            <div class="col-12">
                                        <button type="submit"
                                            name="<?= $editconsultation ? 'update_consultation' : 'add_consultation' ?>"
                                            class="btn <?= $editconsultation ? 'btn-warning' : 'btn-success' ?>">
                                            <?= $editconsultation ? 'Update Consultation' : 'Add New Consultation' ?>
                                        </button>
                            </div>
                        </form>
                                        <div class="mt-4">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Patient Name</th>
                                                            <th>Doctor Name</th>
                                                            <th>Date</th>
                                                            <th>Diagnosis</th>
                                                            <th>Treatment</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($consultations as $consultation): ?>
                                                            <tr class= "<?= ($editconsultation && $editconsultation['consultation_id'] == $consultation['consultation_id']) ? 'table-warning' : '' ?>">
                                                                <td>
                                                                    <?= $consultation['consultation_id'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $consultation['patient_name'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $consultation['doctor_name'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $consultation['consultation_date'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $consultation['diagnosis'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $consultation['treatment'] ?>
                                                                </td>
                                                                <td>
                                                                    <a href="?edit_consultation=<?= $consultation['consultation_id'] ?>"
                                                                        class="btn btn-sm btn-warning">Edit</a>
                                                                    <a href="?delete_consultation=<?= $consultation['consultation_id'] ?>"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this consultation?')">Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</body>

</html>