<?php
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';
?>

<?php
// CHECK IF EDIT MODE
$editcustomer = null;
$editmenuitem = null;
$editorder = null;

if (isset($_GET['edit_customer'])) {
    $customer_id = $_GET['edit_customer'];
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE customer_id = ?");
    $stmt->execute([$customer_id]);
    $editcustomer = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET["edit_menuitem"])) {
    $item_id = $_GET["edit_menuitem"];
    $stmt = $pdo->prepare("SELECT * FROM menuitems WHERE item_id = ?");
    $stmt->execute([$item_id]);
    $editmenuitem = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET["edit_order"])) {
    $order_id = $_GET["edit_order"];
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->execute([$order_id]);
    $editorder = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mb-5">

        <!-- Customer Card -->
        <div class="row mb-4 mt-5" id="customers">
            <div class="col-12">
                <div class="card shadow <?= $editcustomer ? 'border-warning' : '' ?>">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?= $editcustomer ? 'Update Customer Details' : 'Add Customer' ?></h4>
                        <?php if ($editcustomer): ?>
                            <a href="?" class="btn btn-sm btn-light">Cancel Edit</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row g-3">
                            <?php if ($editcustomer): ?>
                                <input type="hidden" name="customer_id" value="<?= $editcustomer['customer_id'] ?>">
                            <?php endif; ?>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" class="form-control" name="first_name" 
                                       value="<?= $editcustomer['first_name'] ?? '' ?>" 
                                       placeholder="Enter first name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" class="form-control" name="last_name" 
                                       value="<?= $editcustomer['last_name'] ?? '' ?>" 
                                       placeholder="Enter last name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="tel" class="form-control" name="phone_number" 
                                       value="<?= $editcustomer['phone_number'] ?? '' ?>" 
                                       placeholder="Enter phone number" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="<?= $editcustomer ? 'update_customer' : 'add_customer' ?>" 
                                        class="btn <?= $editcustomer ? 'btn-warning' : 'btn-primary' ?>">
                                    <?= $editcustomer ? 'Update Customer' : 'Add Customer' ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Menu items card -->
        <div class="row mb-4" id="menu">
            <div class="col-12">
                <div class="card shadow <?= $editmenuitem ? 'border-warning' : '' ?>">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?= $editmenuitem ? 'Update Menu Item' : 'Add Menu Item' ?></h4>
                        <?php if ($editmenuitem): ?>
                            <a href="?" class="btn btn-sm btn-light">Cancel Edit</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" class="row g-3">
                            <?php if ($editmenuitem): ?>
                                <input type="hidden" name="item_id" value="<?= $editmenuitem['item_id'] ?>">
                            <?php endif; ?>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Menu Item</label>
                                <input type="text" class="form-control" name="dish_name" 
                                       value="<?= $editmenuitem['dish_name'] ?? '' ?>" 
                                       placeholder="Enter dish name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" step="0.01" class="form-control" name="price" 
                                       value="<?= $editmenuitem['price'] ?? '' ?>" 
                                       placeholder="Enter price" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" name="category" 
                                       value="<?= $editmenuitem['category'] ?? '' ?>" 
                                       placeholder="Enter category" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="<?= $editmenuitem ? 'update_item' : 'add_item' ?>" 
                                        class="btn <?= $editmenuitem ? 'btn-warning' : 'btn-success' ?>">
                                    <?= $editmenuitem ? 'Update Menu Item' : 'Add Menu Item' ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Card -->
        <div class="row mb-4" id="order">
            <div class="col-12">
                <div class="card shadow <?= $editorder ? 'border-warning' : '' ?>">
                    <div class="card-header bg-warning d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0"><?= $editorder ? 'Update Order' : 'Place New Order' ?></h4>
                        <?php if ($editorder): ?>
                            <a href="?" class="btn btn-sm btn-light">Cancel Edit</a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" class="row g-3">
                            <?php if ($editorder): ?>
                                <input type="hidden" name="order_id" value="<?= $editorder['order_id'] ?>">
                            <?php endif; ?>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Customer</label>
                                <select class="form-select" name="customer_id" required>
                                    <option value="">Select Customer</option>
                                    <?php foreach ($customers as $customer): ?>
                                        <option value="<?= $customer['customer_id'] ?>" 
                                            <?= ($editorder && $editorder['customer_id'] == $customer['customer_id']) ? 'selected' : '' ?>>
                                            <?= $customer['first_name'] . ' ' . $customer['last_name'] . ' - ' . $customer['phone_number'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Menu Item</label>
                                <select class="form-select" name="item_id" required>
                                    <option value="">Select Menu Item</option>
                                    <?php foreach ($menuItems as $item): ?>
                                        <option value="<?= $item['item_id'] ?>" 
                                            data-price="<?= $item['price'] ?>"
                                            <?= ($editorder && $editorder['item_id'] == $item['item_id']) ? 'selected' : '' ?>>
                                            <?= $item['dish_name'] . ' - ₱' . $item['price'] . ' (' . $item['category'] . ')' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control" name="quantity" min="1" 
                                       value="<?= $editorder['quantity'] ?? 1 ?>" required>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" name="<?= $editorder ? 'update_order' : 'place_order' ?>" 
                                        class="btn <?= $editorder ? 'btn-warning' : 'btn-warning' ?> btn-lg">
                                    <?= $editorder ? 'Update Order' : 'Place Order' ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display the data -->
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Existing Customers</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($customers as $customer): ?>
                                        <tr class="<?= ($editcustomer && $editcustomer['customer_id'] == $customer['customer_id']) ? 'table-warning' : '' ?>">
                                            <td><?= $customer['first_name'] . ' ' . $customer['last_name'] ?></td>
                                            <td><?= $customer['phone_number'] ?></td>
                                            <td>
                                                <a href="?edit_customer=<?= $customer['customer_id'] ?>"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <a href="?delete_customer=<?= $customer['customer_id'] ?>"
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Menu Items</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Dish</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($menuItems as $item): ?>
                                        <tr class="<?= ($editmenuitem && $editmenuitem['item_id'] == $item['item_id']) ? 'table-warning' : '' ?>">
                                            <td><?= $item['dish_name'] ?></td>
                                            <td>₱<?= $item['price'] ?></td>
                                            <td><?= $item['category'] ?></td>
                                            <td>
                                                <a href="?edit_menuitem=<?= $item['item_id'] ?>"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <a href="?delete_item=<?= $item['item_id'] ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this menu item?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Order List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Dish</th>
                                        <th>Total Price</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr class="<?= ($editorder && $editorder['order_id'] == $order['order_id']) ? 'table-warning' : '' ?>">
                                            <td><?= $order['order_id'] ?></td>
                                            <td><?= $order['customer_name'] ?></td>
                                            <td><?= $order['dish_name'] ?></td>
                                            <td>₱<?= $order['total_price'] ?></td>
                                            <td><?= $order['order_date'] ?></td>
                                            <td>
                                                <a href="?edit_order=<?= $order['order_id'] ?>"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <a href="?delete_orders=<?= $order['order_id'] ?>"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
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

<style>
    .card {
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .border-warning {
        border: 3px solid #ffc107 !important;
    }
    
    .table-warning {
        background-color: #fff3cd !important;
    }
    
    .btn-sm {
        margin: 2px;
    }
    
    .card-header .btn-light {
        background-color: rgba(255, 255, 255, 0.9);
        border: none;
    }
    
    .card-header .btn-light:hover {
        background-color: white;
    }
</style>

</html>