<?php
// Establish a database connection
require 'conn.php';

// Check if ID parameter is received
if (isset($_GET['id_booking'])) {
    $id = $_GET['id_booking'];

    try {
        // Get the table number associated with the booking
        $getTableNumberStmt = $conn->prepare("SELECT no_meja_fk FROM booking WHERE id_booking = :id_booking");
        $getTableNumberStmt->bindParam(':id_booking', $id);
        $getTableNumberStmt->execute();
        $tableNumber = $getTableNumberStmt->fetchColumn();

        // Update the table status to 0
        $updateStatusStmt = $conn->prepare("UPDATE meja SET status_meja = 0 WHERE no_meja = :table_number");
        $updateStatusStmt->bindParam(':table_number', $tableNumber);
        $updateStatusStmt->execute();

        // Prepare and execute the DELETE statement
        $stmt = $conn->prepare("DELETE FROM `booking` WHERE id_booking = :id_booking");
        $stmt->bindParam(':id_booking', $id);
        $stmt->execute();

        header("Location: Tampilan_Booking.php");
        exit(); // Terminate the current script to prevent further execution
    } catch (PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
}
?>