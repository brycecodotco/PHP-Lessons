<?php   
include "connection.php";


// ---Delete functionality---
if(isset($_GET['delete'])){
    $deleteId = $_GET['delete'];
    $sql = "DELETE FROM patient WHERE patientID=$deleteId";
    mysqli_query($conn, $sql);
    echo "Patient deleted successfully! <br><br>";
    
}

// ---Edit Functionality ---
$editId = $_GET['edit'] ?? '';
$PatientName = '';
$PatientAddress = '';
$ContactNumber = '';

if ($editId){
    $result_edit = mysqli_query($conn, 
    "SELECT * FROM patient WHERE patientID='$editId'");
    $row_edit = mysqli_fetch_assoc($result_edit);
    $PatientName = $row_edit['PatientName'];
    $PatientAddress = $row_edit['PatientAddress'];
    $ContactNumber = $row_edit['ContactNumber'];
}

// Add/Update

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $PatientName = $_POST['PatientName'];
    $PatientAddress = $_POST['PatientAddress'];
    $ContactNumber = $_POST['ContactNumber'];

    if (!empty($editId)) {
        // Update existing record
        $sql = "UPDATE patient 
        SET patientName='$PatientName', patientAddress='$PatientAddress', ContactNumber='$ContactNumber' 
        WHERE patientID='$editId'";
        mysqli_query($conn, $sql);
        echo "Patient updated successfully! <br><br>";
        $editId = ''; // Reset edit ID after update
    }
    else{
        // Insert new record
        $sql = "INSERT INTO patient (patientName, patientAddress, ContactNumber) 
        VALUES ('$PatientName', '$PatientAddress', '$ContactNumber')";
        mysqli_query($conn, $sql);
        echo "Patient added successfully! <br><br>";
    }
    header("Location: " . $_SERVER['PHP_SELF']);
} 

//--Get all Patients
$result = mysqli_query($conn, "SELECT * FROM patient");
?>

<!-- HTML FORM -->

<form method="POST">

  <label>Patient Name:</label>

  <input type="text" name="PatientName" value="<?php echo $PatientName; ?>" required><br>



  <label>Patient Address:</label>

  <input type="text" name="PatientAddress" value="<?php echo $PatientAddress; ?>" required><br>



  <label>Contact Number:</label>

  <input type="text" name="ContactNumber" value="<?php echo $ContactNumber; ?>" required><br>



  <button type="submit"><?php echo $editId ? 'Update Patient' : 'Add Patient'; ?></button>

</form>



<!-- PATIENT TABLE -->

<h2>All Patients</h2>
<table border="1" cellpadding="5" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>Contact Number</th>
    <th>Actions</th>
  </tr>
  <?php
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>".$row['PatientId']."</td>";
      echo "<td>".$row['PatientName']."</td>";
      echo "<td>".$row['PatientAddress']."</td>";
      echo "<td>".$row['ContactNumber']."</td>";
      echo "<td>
          <a href='?edit=".$row['PatientId']."'>Edit</a> | 
          <a href='?delete=".$row['PatientId']."' onclick='return confirm(\"Are you sure?\")'>Delete</a>
         </td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='5'>No patients found</td></tr>";
  }
  ?>
</table>
