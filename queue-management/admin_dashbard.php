<?php
session_start();
include 'db/config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

// Fetch all bookings
$stmt = $conn->prepare("SELECT * FROM bookings");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

<h3>Admin Dashboard</h3>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Service</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($booking = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo $booking['user_id']; ?></td>
            <td><?php echo $booking['service']; ?></td>
            <td><?php echo $booking['status']; ?></td>
            <td><?php echo $booking['created_at']; ?></td>
            <td>
                <a href="cancel_booking.php?id=<?php echo $booking['id']; ?>">Cancel</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
