<?php
include_once'conn.php';
$targeted_id = $_GET["id_booking"];
$populateQuery = "SELECT * from booking WHERE id_booking=$targeted_id;";
$populateData=$conn->query($populateQuery);
$row = $populateData->fetch(PDO::FETCH_ASSOC)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Form</title>
    <link rel="stylesheet" href="edit.css" />
</head>
<body>
    <div class ="edit">
    <h2>Edit Form</h2>

    <form method="POST" action="Edit2.php">
        <table>
            <tr>
                <th><label for="IdBooking">Id Booking:</label></th>
                <td><input type="text" id="IdBooking" name="IdBooking" value=<?php echo $row['id_booking'];?> readonly></td>

            </tr>
            <tr>
                <th><label for="NoMeja">Nomor Meja/Kursi:</label></th>
                <td><input type="text" id="NoMeja" name="NoMeja" value=<?php echo $row['no_meja_fk'];?> required></td>
            </tr>
            <tr>
                <th><label for="Nama">Nama:</label></th>
                <td><input type="text" id="Nama" name="Nama" value=<?php echo $row['nama_dipesan'];?> required></td>
            </tr>
            <tr>
                <th><label for="Waktu">Nomor Telepon:</label></th>
                <td><input type="text" id="notelp" name="notelp" value=<?php echo $row['no_telpon'];?> required></td>
            </tr>
            <tr>
                <th><label for="Jummlah">Jumlah Kursi:</label></th>
                <td><input type="text" id="Jumlah" name="Jumlah" value=<?php echo $row['kursi_dipesan'];?> required></td>
            </tr>
            <tr>
                <th><label for="Waktu">Waktu:</label></th>
                <td><input type="datetime-local" id="Waktu" name="Waktu" value=<?php echo $row['waktu'];?> required></td>
            </tr>
            <tr>
                <th><label for="Jummlah">Catatan:</label></th>
                <td><input type="text" id="catatan" name="catatan" value=<?php echo $row['catatan'];?> required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">
                    <input type="submit" value="Submit">
                </td>
            </tr>
        </table>
        </div>
</body>
</html>

