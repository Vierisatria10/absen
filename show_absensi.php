<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Sistem Absensi</span>
        </div>
    </nav>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="row" id="waktu">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Waktu
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" id="timeDisplay">--:--:--</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" id="hari">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Hari / Tanggal
                            </div>
                            <div class="card-body">
                                <h5 class="card-title" id="dateDisplay">--</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Status Absensi
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <td>ABSEN MASUK</td>
                                        <td>:</td>
                                        <td>06:00 - 08:00</td>
                                    </tr>
                                    <tr>
                                        <td>ABSEN PULANG</td>
                                        <td>:</td>
                                        <td>12:00 - 14:00</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="col">
                    <h3>Sistem Absensi SMK Yasfika Kalirejo</h3>
                    <h4>Tempelkan Kartu Anda!</h4>
                </div>
                <div class="col mt-3" id="ada_data" style="display: none;">
                    <div class="card">
                        <div class="card-header">
                            Data Siswa
                        </div>
                        <div class="card-body" id="studentData">
                            <!-- Placeholder untuk menampilkan data siswa -->
                        </div>
                    </div>
                </div>

                <div class="col mt-3 mb-2" id="tidak_ada_data">
                    <div class="card">
                        <div class="card-header">
                            Data Siswa
                        </div>
                        <div class="card-body" height="100px">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="image/avatar.png" class="rounded float-start" height="200px" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th colspan="3">
                                                    <h1>__________</h1>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>KELAS</td>
                                                <td>:</td>
                                                <td>__________</td>
                                            </tr>
                                            <tr>
                                                <td>ALAMAT</td>
                                                <td>:</td>
                                                <td>__________</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    JAM MASUK
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    __________
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    STATUS
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    __________
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function updateClock() {
            let now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();
            let ampm = hours >= 12 ? 'PM' : 'AM';

            hours = hours % 12;
            hours = hours ? hours : 12;

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            let time = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            document.getElementById('timeDisplay').innerText = time;

            let days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            let day = days[now.getDay()];
            let date = now.getDate();
            let months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            let month = months[now.getMonth()];
            let year = now.getFullYear();

            let formattedDate = day + ', ' + date + ' ' + month + ' ' + year;
            document.getElementById('dateDisplay').innerText = formattedDate;
        }

        window.onload = function() {
            setInterval(updateClock, 1000);
            updateClock();
        };

        function loadData() {
            fetch('cek_data_show.php')
                .then(response => response.json())
                .then(data => {
                    const totalRows = data.total;

                    if (totalRows > 0) {
                        document.getElementById('ada_data').style.display = 'block';
                        document.getElementById('tidak_ada_data').style.display = 'none';

                        // Ambil ID dari tmprfid
                        fetch('ambil_id_tmprfid.php') // Ganti 'ambil_id_tmprfid.php' dengan file PHP yang sesuai
                            .then(response => response.json())
                            .then(tmprfidData => {
                                const idSiswa = tmprfidData.id; // ID dari tmprfid yang akan digunakan

                                // Mengambil data siswa berdasarkan ID dari tmprfid
                                fetch(`ambil_data_siswa.php?id=${idSiswa}`) // Ganti 'ambil_data_siswa.php' dengan file PHP yang sesuai
                                    .then(response => response.json())
                                    .then(student => {
                                        const studentDataDiv = document.getElementById('studentData');
                                        // Menampilkan data siswa
                                        studentDataDiv.innerHTML = `
                                    <div class="row">
                                        <div class="col-md-4">
                                             <img src="img/${student.foto_siswa}" class="rounded float-start" height="200px" alt="Foto Siswa">
                                        </div>
                                        <div class="col-md-8">
                                        <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th colspan="3">
                                                    <h1>${student.Nama_Siswa}</h1>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td>KELAS</td>
                                                <td>:</td>
                                                <td>${student.nama_kelas}</td>
                                            </tr>
                                            <tr>
                                                <td>ALAMAT</td>
                                                <td>:</td>
                                                <td>${student.Alamat}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    JAM MASUK
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    06:00 PM
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    STATUS
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    <strong>Tepat Waktu!</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                        </div>
                                    </div>
                                `;
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    } else {
                        document.getElementById('ada_data').style.display = 'none';
                        document.getElementById('tidak_ada_data').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        setInterval(loadData, 2000);
    </script>
</body>

</html>