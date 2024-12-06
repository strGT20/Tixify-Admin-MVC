<?php
if(!isset($_SESSION['id_user']))
    header("Location: ?c=Auth")
?>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="/styles/style.css">
    <title>Tambah Bus Reguler</title>
</head>

<br><br><br><br>
<div class="container">
        <h1>Tambah Bus Rental</h1>
        <form action="?c=Bus&m=insertBusRental" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tipe_bus" class="form-label">Tipe Bus</label>
                <select class="form-control" id="tipe_bus" name="tipe_bus" required>
                    <option value="reguler">Rental</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="no_reg_bus" class="form-label">Nomor Registrasi Bus</label>
                <input type="text" class="form-control" id="no_reg_bus" name="no_reg_bus" required>
            </div>
            <div class="mb-3">
                <label for="kelas_layanan" class="form-label">Kelas Layanan</label>
                <select class="form-control" id="kelas_layanan" name="kelas_layanan" required>
                    <option value="Executive">Executive</option>
                    <option value="Super Executive">Super Executive</option>
                    <option value="Executive Double Decker">Executive Double Decker</option>
                    <option value="Super Executive Double Decker">Super Executive Double Decker</option>
                    <option value="Private Suite">Private Suite</option>
                    <option value="First Class">First Class</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
            </div>
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa</label>
                <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Foto Armada</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
        </form>
    </div>