<?php
// Establish a database connection
require 'conn.php';

// Check if ID parameter is received
if (isset($_POST['IdBooking'])) {
    $id = $_POST['IdBooking'];
    $no_meja = $_POST['NoMeja'];
    $no_telpon = $_POST['notelp'];
    $nama = $_POST['Nama'];
    $email = $_POST['Email'];
    $kursi = $_POST['Jumlah'];
    $waktu = $_POST['Waktu'];
    $catatan = $_POST['catatan'];

    try {
        // Check if the selected table exists in the 'meja' table
        $checkTableStmt = $conn->prepare("SELECT COUNT(*) FROM meja WHERE no_meja = :no_meja");
        $checkTableStmt->bindParam(':no_meja', $no_meja);
        $checkTableStmt->execute();
        $tableExists = $checkTableStmt->fetchColumn();

        if ($tableExists) {
            // Update status meja sebelumnya menjadi 0
            $getPrevTableStmt = $conn->prepare("SELECT no_meja_fk FROM booking WHERE id_booking = :id");
            $getPrevTableStmt->bindParam(':id', $id);
            $getPrevTableStmt->execute();
            $prevTable = $getPrevTableStmt->fetchColumn();

            $updateStatusStmt = $conn->prepare("UPDATE meja SET status_meja = 0 WHERE no_meja = :prev_no_meja");
            $updateStatusStmt->bindParam(':prev_no_meja', $prevTable);
            $updateStatusStmt->execute();

            // Update data booking
            $updateBookingStmt = $conn->prepare("UPDATE `booking` SET no_meja_fk = :no_meja, nama_dipesan = :nama, email = :email, kursi_dipesan = :kursi, waktu = :waktu, no_telpon = :no_telpon, catatan = :catatan WHERE id_booking = :id");
            $updateBookingStmt->bindParam(':no_meja', $no_meja);
            $updateBookingStmt->bindParam(':nama', $nama);
            $updateBookingStmt->bindParam(':email', $email);
            $updateBookingStmt->bindParam(':kursi', $kursi);
            $updateBookingStmt->bindParam(':waktu', $waktu);
            $updateBookingStmt->bindParam(':no_telpon', $no_telpon);
            $updateBookingStmt->bindParam(':catatan', $catatan);
            $updateBookingStmt->bindParam(':id', $id);
            $updateBookingStmt->execute();

            // Update status meja baru menjadi 2
            $updateStatusStmt = $conn->prepare("UPDATE meja SET status_meja = 2 WHERE no_meja = :new_no_meja");
            $updateStatusStmt->bindParam(':new_no_meja', $no_meja);
            $updateStatusStmt->execute();

            header("Location: Tampilan_Booking.php");
            exit(); // Terminate the current script to prevent further execution
        } else {
            echo "Invalid table selection.";
        }
    } catch (PDOException $e) {
        echo "Error updating data: " . $e->getMessage();
    }
}
?>