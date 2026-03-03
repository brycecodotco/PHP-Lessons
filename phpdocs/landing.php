<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';

?>

<?php
// CHECK IF EDIT MODE
$editUser = null;
if (isset($_GET['edit'])) {
  $users_id = $_GET['edit'];
  $stmt = $pdo->prepare("SELECT * FROM users WHERE users_id = ?");
  $stmt->execute([$users_id]);
  $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>PHP FORM</title>
  </head>
  <body class="bg-light py-4">
    <div class="container">
      <div class="row g-4">
        
        <!-- Form -->
        <div class="col-md-5 col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h3 class="card-title h5 mb-3"><?= $editUser ? 'Update User' : 'Add User' ?></h3>
              <form method="POST">
                <?php if (!empty($editUser)): ?>
                <input type="hidden" name="users_id" value="<?= $editUser['users_id'] ?>">
                <?php endif; ?>
                
                <div class="mb-3">
                  <label class="form-label">Name:</label>
                  <input type="text" class="form-control" name="name" value="<?= !empty($editUser) ? htmlspecialchars($editUser['name']) : '' ?>" required>
                </div>
                
                <div class="mb-3">
                  <label class="form-label">Email:</label>
                  <input type="email" class="form-control" name="email" value="<?= !empty($editUser) ? htmlspecialchars($editUser['email']) : '' ?>" required>
                </div>
                
                <div class="mb-3">
                  <label class="form-label">Product:</label>
                  <input type="text" class="form-control" name="product" placeholder="Product" required><br>
                </div>
                
                <div class="mb-3">
                  <label class="form-label">Amount:</label>
                  <input type="number" step="0.01" class="form-control" name="amount" placeholder="Amount" required><br>
                </div>
                
                <!-- Submit buttons -->
                <?php if (!empty($editUser)): ?>
                <div class="d-flex gap-2">
                  <button type="submit" name="update" class="btn btn-primary flex-grow-1">Update</button>
                  <a href="landing.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
                <?php else: ?>
                <button type="submit" name="add" class="btn btn-primary w-100">Add User</button>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>

        <!--User and Order List-->
        <div class="col-md-7 col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body">
              <h3 class="card-title h5 mb-3"><i class="bi bi-people-fill"></i>User & Order List</h3>
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Product</th>
                      <th>Amount</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($users as $user): ?>
                     <tr>
                  <td><?= $user['users_id'] ?></td>
                  <td><?= $user['name'] ?></td>
                  <td><?= $user['email'] ?></td>
                  <td><?= $user['product'] ?> </td>
                  <td><?= $user['amount'] ?></td>
                  <td>
                    <a href="?edit=<?= $user['users_id'] ?>">Edit</a> |
                    <a href="?delete=<?= $user['users_id'] ?>">Delete</a>
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
  </body>
</html>