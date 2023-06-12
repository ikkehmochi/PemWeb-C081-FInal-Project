<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "final_project";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah ada data yang dikirim dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari input
    $tableId = $_POST["table_id"];
    $bookingId = $_GET["id_booking"] ?? '';

    // Query untuk mengupdate data no_mejares pada booking
    $sql = "UPDATE booking SET no_mejares = '$tableId' WHERE id_booking = '$bookingId'";

    if ($conn->query($sql) === TRUE) {
        // Data berhasil diupdate
        $conn->close();
        header("Location: tengkyu.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Restaurant</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <!-- Reservation Step Two Form Section -->
    <section class="my-5">
        <div class="container">
            <div class="row my-4 mx-1">
                <div class="col-md-12 mx-auto bg-primary text-white p-md-5 p-4 shadow-lg rounded-3">
                    <small>RESERVASI RESTAURANT</small>
                    <h1 class="fw-bold">Reservasi tempat meja di Restaurant</h1>
                    <p>Pilih meja tempat Anda reservasi di Restaurant</p>
                    <hr />
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row g-3">
                        <div class="col-md-12">
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
                                $sql = "SELECT * FROM meja WHERE status_meja = 'Tersedia'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($table = $result->fetch_assoc()) {
                                        echo "<option value=\"" . $table['no_meja'] . "\">Meja " . $table['no_meja'] . " (" . $table['jumlah_kursi'] . " Kursi)</option>";
                                    }
                                } else {
                                    echo "<option disabled>Tidak ada meja yang tersedia</option>";
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mx-auto mt-4 text-center">
                            <button type="submit" class="btn btn-outline-light text-white px-5 py-2 fw-bold">
                                Selanjutnya &nbsp; <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>