<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sirere</title>
    <link rel="stylesheet" href="tampilanB.css">

    <style>
    </style>
</head>

<body>
    <!-- ------------------------ Bagian Formulir Langkah Pertama Reservasi ------------------------ -->

    <button onclick="location.href='index.php'" class="learn-more">
        <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
        </span>
        <span class="button-text">Back</span>
    </button>


    <div class="container mt-5 bg-white p-md-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="h2 font-weight-bold">Daftar Booking</div>
            <button class="btn btn-primary text-white px-5" onclick="location.href='reservation-1.php'" type="button">
                <i class="fas fa-calendar-plus"></i> Tambah Booking
            </button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="small">Id Booking</th>
                        <th scope="col" class="small">Nama Pemesan</th>
                        <th scope="col" class="small">Email</th>
                        <th scope="col" class="small">No. Telepon</th>
                        <th scope="col" class="small">Tanggal Reservasi</th>
                        <th scope="col" class="small">Jumlah Kursi</th>
                        <th scope="col" class="small">No Meja/Kursi</th>
                        <th scope="col" class="small">Catatan</th>
                        <th scope="col" class="small">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                include ('conn.php');
                $no=1;
                $ambildata = $conn->prepare("SELECT * FROM `booking`");
                $ambildata->execute();

                while ($tampil = $ambildata->fetch(PDO::FETCH_ASSOC)) {
                    $row_class = $no % 2 == 0 ? 'even' : 'odd'; // Menentukan kelas baris ganjil atau genap
                    echo '
                    <tr class="bg-blue '.$row_class.'">
                        <td class="pt-3">'.$tampil['id_booking'].'</td>
                        <td class="pt-3">'.$tampil['nama_dipesan'].'</td>
                        <td class="pt-3">'.$tampil['email'].'</td>
                        <td class="pt-3">'.$tampil['no_telpon'].'</td>
                        <td class="pt-3">'.$tampil['waktu'].'</td>
                        <td class="pt-3">'.$tampil['kursi_dipesan'].'</td>
                        <td class="pt-3">'.$tampil['no_meja_fk'].'</td>
                        <td class="pt-3">'.$tampil['catatan'].'</td>
                        <td class="pt-3 mb-3">
    <div class="d-flex justify-content-end">
        <a class="btn btn-danger
        mr-2" onclick="deleteData('.$tampil['id_booking'].')">Delete</a>
        <a class="btn btn-primary" onclick="editData('.$tampil['id_booking'].')">Edit</a>
    </div>
</td>
                    </tr>
                    <tr style="padding-bottom: 10px;">
                        <td></td>
                    </tr>';

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
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>