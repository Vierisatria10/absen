<?php
if (isset($_GET['rfid_code'])) {
    // Ambil nilai dari parameter rfid_code
    $rfid_code = $_GET['rfid_code'];

    // Tambahkan leading zeros jika perlu
    $rfid_code_padded = str_pad($rfid_code, 10, "0", STR_PAD_LEFT);

    // Lakukan koneksi ke database (disesuaikan dengan informasi koneksi Anda)
    include 'koneksi.php';

    // Prepared statement untuk mencegah SQL injection
    $sqlInsert = "INSERT INTO tmprfid (id) VALUES (?)";
    $stmtInsert = mysqli_prepare($conn, $sqlInsert);

    if ($stmtInsert) {
        // Bind parameter ke pernyataan dan eksekusi
        mysqli_stmt_bind_param($stmtInsert, "s", $rfid_code_padded);
        if (mysqli_stmt_execute($stmtInsert)) {
            echo "Data berhasil ditambahkan ke tabel tmprfid.";

            // Bersihkan dan tutup statement serta koneksi
            mysqli_stmt_close($stmtInsert);
            mysqli_close($conn);
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal menyiapkan pernyataan SQL untuk penambahan data.";
    }

    // Sambungkan kembali ke database
    include 'koneksi.php';

    // Ambil data dari tmprfid
    $sqlSelect = "SELECT * FROM tmprfid";
    $result = mysqli_query($conn, $sqlSelect);

    if ($result) {
        // Ambil baris pertama hasil eksekusi kueri (karena sudah ada INSERT sebelumnya)
        $row = mysqli_fetch_assoc($result);
        $rfid_id = $row['id'];

        // Lakukan operasi yang Anda butuhkan pada $rfid_id
        $waktu_sekarang = date('Y-m-d H:i:s');
        $keterangan = 'hadir';

        // Lakukan koneksi ke database (sesuaikan dengan informasi koneksi Anda)
        include 'koneksi.php';

        // Prepared statement untuk memasukkan data ke tabel `absensi`
        $sqlInsertAbsensi = "INSERT INTO absensi (ID_Siswa, Waktu_Absensi, Keterangan) VALUES (?, ?, ?)";
        $stmtInsertAbsensi = mysqli_prepare($conn, $sqlInsertAbsensi);

        if ($stmtInsertAbsensi) {
            mysqli_stmt_bind_param($stmtInsertAbsensi, "sss", $rfid_id, $waktu_sekarang, $keterangan);
            if (mysqli_stmt_execute($stmtInsertAbsensi)) {
                echo "Data berhasil ditambahkan ke tabel absensi.";

                // Ambil nama siswa berdasarkan ID_Siswa dari tabel absensi
                $sqlGetStudentName = "SELECT Nama_Siswa FROM siswa WHERE ID_Siswa = ?";
                $stmtGetStudentName = mysqli_prepare($conn, $sqlGetStudentName);

                if ($stmtGetStudentName) {
                    mysqli_stmt_bind_param($stmtGetStudentName, "s", $rfid_id);
                    mysqli_stmt_execute($stmtGetStudentName);
                    mysqli_stmt_bind_result($stmtGetStudentName, $nama_siswa);
                    mysqli_stmt_fetch($stmtGetStudentName);

                    $jam_absensi = date('H:i:s'); // Waktu absensi sekarang
                    $status = 'Tepat Waktu!';

                    $message = urlencode("$nama_siswa telah absen masuk pada pukul: $jam_absensi. Status: $status");
                    $botToken = '6406105621:AAFMQNcRcZi6bbqKgooaHqORzhx1BWmaLW0'; // Ganti dengan token bot Telegram Anda
                    $chatId = '1146265784'; // Ganti dengan chat_id tujuan

                    $telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=$message";

                    // Kirim permintaan ke API Telegram menggunakan cURL
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    echo "Pesan terkirim ke Telegram: $message";

                    mysqli_stmt_close($stmtGetStudentName);
                    mysqli_stmt_close($stmtInsertAbsensi);
                } else {
                    echo "Gagal mengambil nama siswa dari tabel siswa: " . mysqli_error($conn);
                }
            } else {
                echo "Gagal menambahkan data ke tabel absensi: " . mysqli_error($conn);
            }
        } else {
            echo "Gagal menyiapkan pernyataan SQL untuk tabel absensi.";
        }
    } else {
        echo "Gagal mengeksekusi query: " . mysqli_error($conn);
    }
}
sleep(1);
$sqlEmpty = "DELETE FROM tmprfid";
if (mysqli_query($conn, $sqlEmpty)) {
    echo "Tabel tmprfid berhasil dikosongkan.";
} else {
    echo "Gagal mengosongkan tabel tmprfid: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
