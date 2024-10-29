<?php
// update_reservation_status.php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "facility_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $conn->real_escape_string($_POST['id']);
    $action = $conn->real_escape_string($_POST['action']);

    $new_status = '';
    if ($action === 'approve') {
        $new_status = 'approved';
    } elseif ($action === 'reject') {
        $new_status = 'rejected';
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        exit;
    }

    $sql = "UPDATE reservations SET status = '$new_status' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'message' => 'Reservation updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating reservation: ' . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
