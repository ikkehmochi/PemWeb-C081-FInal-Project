<?php
// Establish a database connection
require 'conn.php';

// Check if ID parameter is received
if (isset($_POST['IdBooking'])) {
    $id = $_POST['IdBooking'];
    $no_meja = $_POST['NoMeja'];
    $no_telpon = $_POST['notelp'];
    $nama = $_POST['Nama'];
    $kursi = $_POST['Jumlah'];
    $waktu = $_POST['Waktu'];
    $catatan = $_POST['catatan'];

    try {
        $stmt = $conn->prepare("UPDATE `booking` SET no_meja_fk = :no_meja, nama_dipesan = :nama, kursi_dipesan = :kursi, waktu = :waktu, no_telpon= :no_telpon, catatan= :catatan WHERE id_booking = :id");
        $stmt->bindParam(':no_meja', $no_meja);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':kursi', $kursi);
        $stmt->bindParam(':waktu', $waktu);
        $stmt->bindParam(':no_telpon', $no_telpon);
        $stmt->bindParam(':catatan', $catatan);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("location:Tampilan_Booking.php");
    } catch (PDOException $e) {
        echo "Error updating data: " . $e->getMessage();
    }
}
?>