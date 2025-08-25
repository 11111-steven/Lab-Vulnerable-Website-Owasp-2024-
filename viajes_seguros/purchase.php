<?php
require_once 'includes/db.php';

if (!isset($_SESSION['userid'])) {
    header("Location: login.php?error=login_required");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['destination_id']) || !isset($_POST['final_price'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['userid'];
$destination_id = $_POST['destination_id'];


$final_price = $_POST['final_price'];


$stmt = $conn->prepare("INSERT INTO purchases (uuid, user_id, destination_id, final_price) VALUES (UUID(), ?, ?, ?)");
$stmt->bind_param("iid", $user_id, $destination_id, $final_price);

if ($stmt->execute()) {
    header("Location: dashboard.php?purchase=success");
} else {
    header("Location: destination_details.php?id=" . $destination_id . "&error=purchasefailed");
}

$stmt->close();
$conn->close();
exit();
?>