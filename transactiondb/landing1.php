 <?php
    require 'insert.php';
    require 'update.php';
    require 'delete.php';
    require 'select.php';
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
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Add Customer</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="tel" class="form-control" name="phone_number" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="add_customer" class="btn btn-primary">Add </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<!--Add Menu items card-->
        <div class="row mb-4" id="menu">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Add Menu Item</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Menu Item</label>
                                <input type="text" class="form-control" name="dish_name" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" step="0.01" class="form-control" name="price" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Category</label>
                                <input type="text" class="form-control" name="category" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="add_item" class="btn btn-success">
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Card-->
        <div class="row" id="order">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class=" text-white mb-0">Place New Order</h4>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="" class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Customer</label>
                                <select class="form-select" name="customer_id" required>
                                    <option value=""></option>
                                    <?php foreach($customers as $customer): ?>
                                        <option value="<?= $customer['customer_id'] ?>">
                                            <?= $customer['first_name'] . ' ' . $customer['last_name'] . ' - ' . $customer['phone_number'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- dropdown for menu item selection -->
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Menu Item</label>
                                <select class="form-select" name="item_id" required>
                                    <option value="">  </option>
                                    <?php foreach($menuItems as $item): ?>
                                        <option value="<?= $item['item_id'] ?>" data-price="<?= $item['price'] ?>">
                                            <?= $item['dish_name'] . ' - $' . $item['price'] . ' (' . $item['category'] . ')' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control" name="quantity" min="1" value="1" required>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" name="place_order" class="btn btn-warning btn-lg">
                                    Place Order
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display the data-->
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
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($customers as $customer): ?>
                                    <tr>
                                        <td><?= $customer['first_name'] . ' ' . $customer['last_name'] ?></td>
                                        <td><?= $customer['phone_number'] ?></td>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($menuItems as $item): ?>
                                    <tr>
                                        <td><?= $item['dish_name'] ?></td>
                                        <td>$<?= $item['price'] ?></td>
                                        <td><?= $item['category'] ?></td>
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
                                    <?php foreach($orders as $order): ?>
                                    <tr>
                                        <td><?= $order['order_id'] ?></td>
                                        <td><?= $order['customer_name'] ?></td>
                                        <td><?= $order['dish_name'] ?></td>
                                        <td>₱<?= $order['total_price'] ?></td>
                                        <td><?= $order['date'] ?></td>
                                        <td>
                                            <a href="?edit=<?= $order['order_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="?delete=<?= $order['order_id'] ?>" class="btn btn-sm btn-danger">Delete</a>
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