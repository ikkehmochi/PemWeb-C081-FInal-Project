<?php
include_once 'conn.php';
$targeted_id = $_GET["id_booking"];
$populateQuery = "SELECT * FROM booking WHERE id_booking = :id";
$populateData = $conn->prepare($populateQuery);
$populateData->bindParam(':id', $targeted_id);
$populateData->execute();
$row = $populateData->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Formulir Reservasi</title>
</head>

<body>

    <button onclick="location.href='index.php'" class="learn-more">
        <span class="circle" aria-hidden="true">
            <span class="icon arrow"></span>
        </span>
        <span class="button-text">Back</span>
    </button>

    <section class="my-4">
        <div class="container">
            <div class="row my-4 mx-1">
                <div class="col-md-12 mx-auto bg-primary text-white p-md-5 p-4 shadow-lg rounded-3">
                    <small>SiRere</small>
                    <h1 class="fw-bold">Edit Data Booking</h1>
                    <p>Isi formulir di bawah ini dengan benar untuk mengedit data reservasi di Restoran</p>
                    <hr />
                    <form method="POST" action="edit2.php" class="row g-3">
                        <div class="col-md-6">
                            <label for="IdBooking" class="form-label">Id Booking</label>
                            <input type="text" class="form-control" id="IdBooking" name="IdBooking"
                                value="<?php echo $row['id_booking']; ?>" readonly />
                        </div>
                        <div class="col-md-6">
                            <label for="Nama" class="form-label">Nama Lengkap</label>
                            <input type="text" id="Nama" name="Nama" value="<?php echo $row['nama_dipesan']; ?>"
                                required class="form-control" />
                        </div>
                        <div class="col-md-12">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" name="Email" value="<?php echo $row['email']; ?>" class="form-control"
                                id="Email" required />
                        </div>
                        <div class="col-md-12">
                            <label for="notelp" class="form-label">Nomor Telepon</label>
                            <input type="tel" id="notelp" name="notelp" value="<?php echo $row['no_telpon']; ?>"
                                required class="form-control" />
                        </div>
                        <div class="col-md-12">
                            <label for="Waktu" class="form-label">Tanggal Reservasi</label>
                            <input type="datetime-local" id="Waktu" name="Waktu"
                                value="<?php echo date('Y-m-d\TH:i', strtotime($row['waktu'])); ?>"
                                min="<?php echo $min_date; ?>" max="<?php echo $max_date; ?>" class="form-control"
                                required />
                            <span class="mt-1 fs-12">Silakan pilih jam antara 17:00-23:00.</span>
                        </div>
                        <div class="col-md-6">
                            <label for="Jumlah" class="form-label">Jumlah Tamu</label>
                            <select id="Jumlah" name="Jumlah" class="form-select" required>
                                <option selected disabled>Pilih jumlah tamu...</option>
                                <?php
            for ($i = 1; $i <= 6; $i++) {
                if ($i == $row['kursi_dipesan']) {
                    echo "<option value=\"$i\" selected>$i</option>";
                } else {
                    echo "<option value=\"$i\">$i</option>";
                }
            }
            ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="NoMeja" class="form-label">Pilih Meja</label>
                            <select id="NoMeja" name="NoMeja" required class="form-select">
                                <option selected disabled>Pilih Meja ...</option>
                                <?php
            
            $mejaQuery = "SELECT * FROM meja WHERE status_meja = 0";
            $mejaQuery = "SELECT * FROM meja";
            $mejaData = $conn->query($mejaQuery);
            while ($mejaRow = $mejaData->fetch(PDO::FETCH_ASSOC)) {
                $noMeja = $mejaRow['no_meja'];
                $kursi = $mejaRow['jumlah_kursi'];
                $lantai = $mejaRow['lantai'];
                $selected = ($row['no_meja_fk'] == $noMeja) ? 'selected' : '';

                echo "<option value=\"$noMeja\" $selected>Lantai $lantai, Meja $noMeja (Kursi $kursi)</option>";
            }
            ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea id="catatan" name="catatan"
                                class="form-control"><?php echo $row['catatan']; ?></textarea>
                        </div>
                        <div class="col-md-12 mx-auto mt-4 text-center">
                            <p class="text-center col-md-8 mx-auto">
                                Harap konfirmasi data dan nomor telepon yang telah diisi.
                            </p>
                            <button type="submit" class="btn btn-outline-light text-white px-5 py-2 fw-bold">
                                Simpan &nbsp; <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var tanggalResInput = document.getElementById('waktu');
        var form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            var selectedDateTime = new Date(tanggalResInput.value);
            var minDateTime = new Date('<?php echo $min_date; ?>');
            var maxDateTime = new Date('<?php echo $max_date; ?>');

            if (selectedDateTime < minDateTime || selectedDateTime > maxDateTime) {
                event.preventDefault(); // Prevent form submission
                alert('Silakan pilih jam antara 17:00-23:00.');
                tanggalResInput.value = ''; // Reset the value of tanggalResInput
            }
        });
    });
    </script>
</body>

</html>