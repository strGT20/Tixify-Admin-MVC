<?php
if(!isset($_SESSION['id_user']))
    header("Location: ?c=Auth")
?>

<head>
    <title>Tambah Bus Reguler</title>
</head>

<br><br><br><br>
<div class="container">
        <h1>Tambah Bus Reguler</h1>
        <form action="?c=Bus&m=insertBusReguler" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tipe_bus" class="form-label">Tipe Bus</label>
                <select class="form-control" id="tipe_bus" name="tipe_bus" required>
                    <option value="reguler">Reguler</option>
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
                <label for="rute" class="form-label">Rute</label>
                <input type="text" class="form-control" id="rute" name="rute" required>
            </div>
            <div class="mb-3">
                <label for="harga_tiket" class="form-label">Harga Tiket</label>
                <input type="number" class="form-control" id="harga_tiket" name="harga_tiket" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Foto Armada</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
        </form>
</div>
