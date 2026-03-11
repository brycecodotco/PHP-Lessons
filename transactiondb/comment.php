<?php
/*
 * ============================================================
 * SECTION 1: INCLUDES AND INITIAL SETUP
 * ============================================================
 * These files contain the database connection and the actual
 * SQL queries for inserting, updating, deleting, and selecting data.
 * They are required here so their functions/variables are available.
 */
require 'insert.php';   // Contains INSERT SQL queries for all tables
require 'update.php';   // Contains UPDATE SQL queries for all tables
require 'delete.php';   // Contains DELETE SQL queries for all tables
require 'select.php';   // Contains SELECT SQL queries and fetches all data ($customers, $menuItems, $orders)

/*
 * ============================================================
 * SECTION 2: EDIT MODE DETECTION
 * ============================================================
 * Check if any of the edit links were clicked (they pass IDs in the URL)
 * If so, fetch that specific record from the database to pre-fill the forms
 */

// Initialize edit variables as null (not in edit mode)
$editcustomer = null;   // Holds customer data when editing a customer
$editmenuitem = null;   // Holds menu item data when editing a menu item
$editorder = null;      // Holds order data when editing an order

// Check if customer edit link was clicked (e.g., ?edit_customer=5)
if (isset($_GET['edit_customer'])) {
    $customer_id = $_GET['edit_customer'];                       // Get the customer ID from URL
    $stmt = $pdo->prepare("SELECT * FROM customers WHERE customer_id = ?"); // Prepare SQL to fetch specific customer
    $stmt->execute([$customer_id]);                              // Execute with the ID parameter
    $editcustomer = $stmt->fetch(PDO::FETCH_ASSOC);             // Store the fetched data for form pre-filling
}

// Check if menu item edit link was clicked (e.g., ?edit_menuitem=3)
if (isset($_GET["edit_menuitem"])) {
    $item_id = $_GET["edit_menuitem"];                           // Get the menu item ID from URL
    $stmt = $pdo->prepare("SELECT * FROM menuitems WHERE item_id = ?");  // Prepare SQL to fetch specific menu item
    $stmt->execute([$item_id]);                                  // Execute with the ID parameter
    $editmenuitem = $stmt->fetch(PDO::FETCH_ASSOC);             // Store the fetched data for form pre-filling
}

// Check if order edit link was clicked (e.g., ?edit_order=8)
if (isset($_GET["edit_order"])) {
    $order_id = $_GET["edit_order"];                             // Get the order ID from URL
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");    // Prepare SQL to fetch specific order
    $stmt->execute([$order_id]);                                 // Execute with the ID parameter
    $editorder = $stmt->fetch(PDO::FETCH_ASSOC);                // Store the fetched data for form pre-filling
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management System</title>
    <!-- Bootstrap CSS for styling and responsive design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JavaScript for interactive components (dropdowns, modals, etc.) -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light"> <!-- Light gray background for the entire page -->
    <div class="container mb-5"> <!-- Main container with bottom margin -->

        <!-- 
        ============================================================
        SECTION 3: CUSTOMER MANAGEMENT FORM
        ============================================================
        This form handles both adding new customers and editing existing ones.
        The appearance changes based on whether we're in edit mode ($editcustomer).
        -->

        <div class="row mb-4 mt-5" id="customers"> <!-- Row with bottom margin and top margin, anchored ID for navigation -->
            <div class="col-12"> <!-- Full width column -->
                <!-- Card component: if in edit mode, add a yellow warning border for visual feedback -->
                <div class="card shadow <?= $editcustomer ? 'border-warning' : '' ?>">
                    <!-- Card header: Blue for add mode, but shows different title and cancel button in edit mode -->
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <!-- Dynamic header text: changes based on edit mode -->
                        <h4 class="mb-0"><?= $editcustomer ? 'Update Customer Details' : 'Add Customer' ?></h4>
                        
                        <!-- Show cancel button only when in edit mode (allows user to exit edit mode) -->
                        <?php if ($editcustomer): ?>
                            <a href="?" class="btn btn-sm btn-light">Cancel Edit</a> <!-- "?" reloads page without URL parameters -->
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body">
                        <!-- Form submits back to the same page (POST method) -->
                        <form method="POST" class="row g-3"> <!-- g-3 adds gutters between form fields -->
                            
                            <!-- Hidden input: only included when editing, stores the customer ID for the update query -->
                            <?php if ($editcustomer): ?>
                                <input type="hidden" name="customer_id" value="<?= $editcustomer['customer_id'] ?>">
                            <?php endif; ?>
                            
                            <!-- First Name field -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" class="form-control" name="first_name" 
                                       value="<?= $editcustomer['first_name'] ?? '' ?>" <!-- Pre-fill if editing, otherwise empty -->
                                       placeholder="Enter first name" required> <!-- Required attribute prevents empty submission -->
                            </div>
                            
                            <!-- Last Name field -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" class="form-control" name="last_name" 
                                       value="<?= $editcustomer['last_name'] ?? '' ?>" 
                                       placeholder="Enter last name" required>
                            </div>
                            
                            <!-- Phone Number field (type="tel" for mobile number keyboard) -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="tel" class="form-control" name="phone_number" 
                                       value="<?= $editcustomer['phone_number'] ?? '' ?>" 
                                       placeholder="Enter phone number" required>
                            </div>
                            
                            <!-- Submit button: dynamic name and appearance based on edit mode -->
                            <div class="col-12">
                                <button type="submit" name="<?= $editcustomer ? 'update_customer' : 'add_customer' ?>" 
                                        class="btn <?= $editcustomer ? 'btn-warning' : 'btn-primary' ?>">
                                    <?= $editcustomer ? 'Update Customer' : 'Add Customer' ?> <!-- Button text changes -->
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- 
        ============================================================
        SECTION 4: MENU ITEM MANAGEMENT FORM
        ============================================================
        Similar structure to customer form but for menu items.
        Handles adding new dishes or editing existing ones.
        -->

        <div class="row mb-4" id="menu">
            <div class="col-12">
                <!-- Card with conditional warning border for edit mode -->
                <div class="card shadow <?= $editmenuitem ? 'border-warning' : '' ?>">
                    <!-- Green header for menu section -->
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?= $editmenuitem ? 'Update Menu Item' : 'Add Menu Item' ?></h4>
                        
                        <!-- Cancel edit button (only shown in edit mode) -->
                        <?php if ($editmenuitem): ?>
                            <a href="?" class="btn btn-sm btn-light">Cancel Edit</a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="" class="row g-3"> <!-- action="" submits to same page -->
                            
                            <!-- Hidden input for item_id when editing -->
                            <?php if ($editmenuitem): ?>
                                <input type="hidden" name="item_id" value="<?= $editmenuitem['item_id'] ?>">
                            <?php endif; ?>
                            
                            <!-- Dish Name field -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Menu Item</label>
                                <input type="text" class="form-control" name="dish_name" 
                                       value="<?= $editmenuitem['dish_name'] ?? '' ?>" 
                                       placeholder="Enter dish name" required>
                            </div>
                            
                            <!-- Price field (step="0.01" allows decimal values for cents/pesos) -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" step="0.01" class="form-control" name="price" 
                                       value="<?= $editmenuitem['price'] ?? '' ?>" 
                                       placeholder="Enter price" required>
                            </div>
                            
                            <!-- Category field (e.g., Appetizer, Main Course, Dessert) -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" name="category" 
                                       value="<?= $editmenuitem['category'] ?? '' ?>" 
                                       placeholder="Enter category" required>
                            </div>
                            
                            <!-- Submit button with dynamic styling -->
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

        <!-- 
        ============================================================
        SECTION 5: ORDER MANAGEMENT FORM
        ============================================================
        This form places new orders or edits existing ones.
        Includes dropdowns that are populated from the database.
        -->

        <div class="row mb-4" id="order">
            <div class="col-12">
                <!-- Card with conditional warning border for edit mode -->
                <div class="card shadow <?= $editorder ? 'border-warning' : '' ?>">
                    <!-- Yellow header for orders section (warning color) -->
                    <div class="card-header bg-warning d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0"><?= $editorder ? 'Update Order' : 'Place New Order' ?></h4>
                        
                        <!-- Cancel edit button -->
                        <?php if ($editorder): ?>
                            <a href="?" class="btn btn-sm btn-light">Cancel Edit</a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="" class="row g-3">
                            
                            <!-- Hidden input for order_id when editing -->
                            <?php if ($editorder): ?>
                                <input type="hidden" name="order_id" value="<?= $editorder['order_id'] ?>">
                            <?php endif; ?>
                            
                            <!-- Customer dropdown - populated from $customers array (from select.php) -->
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Customer</label>
                                <select class="form-select" name="customer_id" required>
                                    <option value="">Select Customer</option> <!-- Default empty option -->
                                    <?php foreach ($customers as $customer): ?> <!-- Loop through all customers -->
                                        <option value="<?= $customer['customer_id'] ?>" 
                                            <!-- Pre-select the current customer if editing -->
                                            <?= ($editorder && $editorder['customer_id'] == $customer['customer_id']) ? 'selected' : '' ?>>
                                            <!-- Display: "First Last - Phone" for easy identification -->
                                            <?= $customer['first_name'] . ' ' . $customer['last_name'] . ' - ' . $customer['phone_number'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- Menu Item dropdown - populated from $menuItems array -->
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Menu Item</label>
                                <select class="form-select" name="item_id" required>
                                    <option value="">Select Menu Item</option>
                                    <?php foreach ($menuItems as $item): ?> <!-- Loop through all menu items -->
                                        <option value="<?= $item['item_id'] ?>" 
                                            data-price="<?= $item['price'] ?>" <!-- Custom attribute for potential JS price calculation -->
                                            <!-- Pre-select the current item if editing -->
                                            <?= ($editorder && $editorder['item_id'] == $item['item_id']) ? 'selected' : '' ?>>
                                            <!-- Display: "Dish Name - ₱Price (Category)" -->
                                            <?= $item['dish_name'] . ' - ₱' . $item['price'] . ' (' . $item['category'] . ')' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <!-- Quantity field -->
                            <div class="col-md-2">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control" name="quantity" min="1" 
                                       value="<?= $editorder['quantity'] ?? 1 ?>" <!-- Default to 1 if new, existing if editing -->
                                       required>
                            </div>
                            
                            <!-- Submit button - always warning color (yellow theme for orders) -->
                            <div class="col-12 mt-3">
                                <button type="submit" name="<?= $editorder ? 'update_order' : 'place_order' ?>" 
                                        class="btn <?= $editorder ? 'btn-warning' : 'btn-warning' ?> btn-lg"> <!-- Large button -->
                                    <?= $editorder ? 'Update Order' : 'Place Order' ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- 
        ============================================================
        SECTION 6: DATA DISPLAY TABLES
        ============================================================
        Three tables that display all existing records with edit/delete options.
        Each table highlights the row that is currently being edited.
        -->

        <div class="row mt-5"> <!-- Row with top margin for the tables -->

            <!-- LEFT COLUMN: Customers Table -->
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-info text-white"> <!-- Blue info header -->
                        <h5 class="mb-0">Existing Customers</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive"> <!-- Makes table scrollable on small screens -->
                            <table class="table table-hover"> <!-- Hover effect on rows -->
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($customers as $customer): ?> <!-- Loop through all customers -->
                                        <!-- Add warning background if this row matches the currently edited customer -->
                                        <tr class="<?= ($editcustomer && $editcustomer['customer_id'] == $customer['customer_id']) ? 'table-warning' : '' ?>">
                                            <td><?= $customer['first_name'] . ' ' . $customer['last_name'] ?></td> <!-- Concatenate full name -->
                                            <td><?= $customer['phone_number'] ?></td>
                                            <td>
                                                <!-- Edit link: passes customer ID to URL to trigger edit mode -->
                                                <a href="?edit_customer=<?= $customer['customer_id'] ?>"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <!-- Delete link: passes delete parameter with confirmation dialog -->
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

            <!-- MIDDLE COLUMN: Menu Items Table -->
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
                                    <?php foreach ($menuItems as $item): ?> <!-- Loop through all menu items -->
                                        <!-- Highlight if this item is being edited -->
                                        <tr class="<?= ($editmenuitem && $editmenuitem['item_id'] == $item['item_id']) ? 'table-warning' : '' ?>">
                                            <td><?= $item['dish_name'] ?></td>
                                            <td>₱<?= $item['price'] ?></td> <!-- Add peso sign -->
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

            <!-- RIGHT COLUMN: Orders Table -->
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
                                    <?php foreach ($orders as $order): ?> <!-- Loop through all orders -->
                                        <!-- Highlight if this order is being edited -->
                                        <tr class="<?= ($editorder && $editorder['order_id'] == $order['order_id']) ? 'table-warning' : '' ?>">
                                            <td><?= $order['order_id'] ?></td>
                                            <td><?= $order['customer_name'] ?></td> <!-- From JOIN query in select.php -->
                                            <td><?= $order['dish_name'] ?></td> <!-- From JOIN query in select.php -->
                                            <td>₱<?= $order['total_price'] ?></td> <!-- Calculated as price * quantity -->
                                            <td><?= $order['order_date'] ?></td> <!-- Timestamp from database -->
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
    </div> <!-- End of main container -->

    <!-- 
    ============================================================
    SECTION 7: CUSTOM STYLES
    ============================================================
    Additional CSS to enhance the Bootstrap styling
    -->
    <style>
        .card {
            margin-bottom: 20px;          /* Space between cards */
            transition: all 0.3s ease;    /* Smooth animations for hover effects */
        }
        
        .border-warning {
            border: 3px solid #ffc107 !important; /* Thicker yellow border for edit mode */
        }
        
        .table-warning {
            background-color: #fff3cd !important; /* Light yellow background for editing rows */
        }
        
        .btn-sm {
            margin: 2px;                   /* Tiny spacing between action buttons */
        }
        
        .card-header .btn-light {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent cancel button */
            border: none;                    /* Remove button border */
        }
        
        .card-header .btn-light:hover {
            background-color: white;          /* Fully white on hover */
        }
    </style>

</body>

</html>