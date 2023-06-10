<?php
// Establish a database connection
require 'conn.php';
// Check if ID parameter is received
if (isset($_GET['id_booking'])) {
    $id = $_GET['id_booking'];

    try {
        // Prepare and execute the DELETE statement
        $stmt = $conn->prepare("DELETE FROM `booking` WHERE id_booking = :id_booking");
        $stmt->bindParam(':id_booking', $id); // Fix the parameter name here
        $stmt->execute();

        header("location:Tampilan_Booking.php");
    } catch (PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
}
?>
