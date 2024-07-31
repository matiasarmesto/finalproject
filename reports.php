<?php
// Define the roles allowed to access this page
$page_roles = array('admin');

// Include the necessary files for database connection and authorization
include('dbconnection.php');
include('checksession.php');

// Check if the user is an admin
if (!in_array('admin', $page_roles)) {
    header('Location: login.php');
    exit();
}

// Query to fetch sales report data
$query = "
    SELECT orders.order_id, orders.user_id, orders.order_date, orders.total_amount,
           order_items.order_item_id, order_items.drama_id, order_items.quantity, order_items.unit_price
    FROM orders
    JOIN order_items ON orders.order_id = order_items.order_id
    ORDER BY orders.order_date DESC
";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <?php include('header.html'); ?>
    </header>
    <main class="container mt-5">
        <h1>Sales Report</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Order Item ID</th>
                        <th>Drama ID</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_amount']); ?></td>
                            <td><?php echo htmlspecialchars($row['order_item_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['drama_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['unit_price']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No sales data available.</p>
        <?php endif; ?>
    </main>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
