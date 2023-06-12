<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "final_project";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dipesan = $_POST["nama_depan"];
    $email = $_POST["email"];
    $no_telpon = $_POST["no_telepon"];
    $waktu = $_POST["tanggal_res"];
    $kursi_dipesan = $_POST["jumlah_tamu"];
    $no_meja_fk = $_POST["table_id"];
    $catatan = $_POST["catatan"];
    
    $min_time = "17:00";
    $max_time = "23:00";
    $min_date = date("Y-m-d") . "T" . $min_time;
    $max_date = date("Y-m-d") . "T" . $max_time;

    // Check if the selected time is within the allowed range
    $selectedDateTime = new DateTime($waktu);
    $minDateTime = new DateTime($min_date);
    $maxDateTime = new DateTime($max_date);

    if ($selectedDateTime < $minDateTime || $selectedDateTime > $maxDateTime) {
        echo "<script>alert('Silakan pilih jam antara 17:00-23:00.')</script>";
    } else {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO booking (nama_dipesan, email, no_telpon, waktu, kursi_dipesan, no_meja_fk, catatan) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiss", $nama_dipesan, $email, $no_telpon, $waktu, $kursi_dipesan, $no_meja_fk, $catatan);

        if ($stmt->execute()) {
            $stmt->close();

            // Update the table status to "reserved"
            $update_query = "UPDATE meja SET status_meja = 2 WHERE no_meja = $no_meja_fk";
            $conn->query($update_query);

            $conn->close();
            header("Location: tengkyu.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
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

    <section class="my-5">
        <div class="container">
            <div class="row my-4 mx-1">
                <div class="col-md-12 mx-auto bg-primary text-white p-md-5 p-4 shadow-lg rounded-3">
                    <small>RESERVASI RESTAURANT</small>
                    <h1 class="fw-bold">Reservasi Tempat Meja di Restoran</h1>
                    <p>Isi formulir di bawah ini dengan benar untuk melakukan reservasi di Restoran</p>
                    <hr />
                    <form method="POST" action="reservation-1.php" class="row g-3">
                        <div class="col-md-6">
                            <label for="nama_depan_input" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_depan" placeholder="Masukkan nama lengkap anda"
                                class="form-control" id="nama_depan_input" required />
                        </div>
                        <div class="col-md-6">
                            <label for="email_input" class="form-label">Email</label>
                            <input type="email" name="email" placeholder="contoh: restawrant@example.com"
                                class="form-control" id="email_input" required />
                        </div>
                        <div class="col-md-12">
                            <label for="nomor_telepon_input" class="form-label">Nomor Telepon</label>
                            <input type="tel" name="no_telepon" placeholder="Masukkan nomor telepon Anda"
                                class="form-control" id="nomor_telepon_input" required />
                        </div>
                        <div class="col-md-12">
                            <label for="tanggal_reservasi_input" class="form-label">Tanggal Reservasi</label>
                            <input type="datetime-local" id="tanggal_reservasi_input" name="tanggal_res"
                                min="<?php echo $min_date; ?>" max="<?php echo $max_date; ?>" class="form-control"
                                required />
                            <span class="mt-1 fs-12">Silakan pilih jam antara 17:00-23:00.</span>
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah_tamu_input" class="form-label">Jumlah Tamu</label>
                            <select name="jumlah_tamu" id="jumlah_tamu_input" class="form-select" required>
                                <option selected disabled>Pilih jumlah tamu...</option>
                                <?php
                for ($i = 1; $i <= 6; $i++) {
                    echo "<option value=\"$i\">$i</option>";
                }
            ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="table_id" class="form-label">Pilih Meja</label>
                            <select name="table_id" id="table_id" class="form-select">
                                <option selected disabled>Pilih Meja ...</option>
                                <?php
    // Database connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve available tables
    $tanggal_res = $_POST["tanggal_res"];
    $sql = "SELECT * FROM meja WHERE status_meja = 0 AND jumlah_kursi >= 2";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($table = $result->fetch_assoc()) {
            $no_meja = $table['no_meja'];
            $jumlah_kursi = $table['jumlah_kursi'];
            $lantai = $table['lantai'];

            // Check if the table is available on the selected date
            $reservation_check_query = "SELECT * FROM booking WHERE DATE(waktu) = ? AND no_meja_fk = ?";
            $reservation_check_stmt = $conn->prepare($reservation_check_query);
            $reservation_check_stmt->bind_param("ss", $tanggal_res, $no_meja);
            $reservation_check_stmt->execute();
            $reservation_check_result = $reservation_check_stmt->get_result();

            if ($reservation_check_result->num_rows == 0) {
                echo "<option value=\"$no_meja\">Lantai $lantai - Meja $no_meja ($jumlah_kursi Kursi)</option>";
            }
        }
    } else {
        echo "<option disabled>Tidak ada meja yang tersedia</option>";
    }

    // Close the database connection
    $conn->close();
    ?>
                            </select>


                        </div>
                        <div class="col-md-12">
                            <label for="catatan_input" class="form-label">Catatan</label>
                            <textarea name="catatan" placeholder="Tambahkan catatan khusus untuk reservasi Anda..."
                                class="form-control" id="catatan-input"></textarea>
                        </div>
                        <div class="col-md-12 mx-auto mt-4 text-center">
                            <p class="text-center col-md-8 mx-auto">
                                Harap konfirmasi data
                                dan nomor telepon yang telah diisi.
                            </p>
                            <button type="submit" class="btn btn-outline-light text-white px-5 py-2 fw-bold">
                                Buat Reservasi &nbsp; <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var tanggalResInput = document.getElementById('tanggal_reservasi_input');
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