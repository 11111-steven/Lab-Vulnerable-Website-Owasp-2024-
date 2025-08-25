<?php
require_once 'includes/db.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['purchase_id']) || !is_numeric($_GET['purchase_id'])) {
    header("Location: dashboard.php?error=invalidid");
    exit();
}

$purchase_id = $_GET['purchase_id'];

$stmt = $conn->prepare("DELETE FROM purchases WHERE id = ?");
$stmt->bind_param("i", $purchase_id);

if ($stmt->execute()) {
    header("Location: dashboard.php?cancel=success");
} else {
    header("Location: dashboard.php?error=cancelfailed");
}

$stmt->close();
$conn->close();
exit();
?>