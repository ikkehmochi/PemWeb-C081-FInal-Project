<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="tampilanB.css" />
    <title>Daftar Booking SiReRe</title>
</head>
<body>
<a href="index.php" class="home-anchor">
        <table>
            <tr>
                <td><img src="Data\Images\menu.png" alt="back to main menu"></td>
                <td>Back To Main Menu</td>
            </tr>
        </table>
    </a>    
<div class="judul">
    <h3>Daftar Booking</h3>
</div>
<a class="button" href="">Tambah Booking</a>

<div>
    <table class="table2">
        <tr>
            <th>no</th>
            <th>Id Booking</th>
            <th>No Meja/Kursi</th>
            <th>Nama Pemesan</th>
            <th>No. Telepon</th>
            <th>Jumlah Kursi</th>
            <th>Waktu</th>
            <th>Catatan</th>
            <th>Action</th>
        </tr>
        <?php 
        include ('conn.php');
        $no=1;
        $ambildata = $conn->prepare("SELECT * FROM `booking`");
        $ambildata->execute();

        while ($tampil = $ambildata->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <tr>
                <td>$no</td>
                <td>$tampil[id_booking]</td>
                <td>$tampil[no_meja_fk]</td>
                <td>$tampil[nama_dipesan]</td>
                <td>$tampil[no_telpon]</td>
                <td>$tampil[kursi_dipesan]</td>
                <td>$tampil[waktu]</td>
                <td>$tampil[catatan]</td>
                <td>
                <a class=\"delete-link\" onclick=\"deleteData(" . $tampil['id_booking'] . ")\">Delete</a>
                <a class=\"edit-link\" onclick=\"editData(" . $tampil['id_booking'] . ")\">Edit</a>
                </td>
            </tr>";
            $no++;
        }
        ?>

        <script>
            function deleteData(id) {
                if (confirm("Are you sure you want to delete this data?")) {
                    window.location.href = "delete.php?id_booking=" + id;
                }
            }

            function editData(id) {
                // Redirect to the edit page with the specific ID
                window.location.href = "edit.php?id_booking=" + id;
            }
        </script>
    
    </table>
</div>
</body>
</html>
