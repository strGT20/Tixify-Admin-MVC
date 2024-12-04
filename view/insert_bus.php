<?php
// Inisialisasi variabel tipe_bus
$tipe_bus = $_POST['tipe_bus'] ?? null;
?>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="/styles/style.css">
    <title>Daftar Bus</title>
</head>

<div class="container">
    <h1>Tambah Bus Baru</h1>
    <form action="?c=Bus&m=insert" method="post" enctype="multipart/form-data">
        <!-- Dropdown buat pilih tipe bus -->
        <div class="mb-3">
            <label for="tipe_bus" class="form-label">Tipe Bus</label>
            <select class="form-control" id="tipe_bus" name="tipe_bus" required onchange="this.form.submit()">
                <option value="">Pilih Tipe</option>
                <option value="reguler" <?php if ($tipe_bus == 'reguler') echo 'selected'; ?>>Reguler</option>
                <option value="rental" <?php if ($tipe_bus == 'rental') echo 'selected'; ?>>Rental</option>
            </select>
        </div>

        <!-- Input data umum -->
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
            <label for="image" class="form-label">Foto Armada</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <?php if ($tipe_bus == 'reguler'): ?>
            <!-- Field tambahan untuk bus Reguler -->
            <div class="mb-3">
                <label for="rute" class="form-label">Rute (Reguler)</label>
                <input type="text" class="form-control" id="rute" name="rute" required>
            </div>

            <div class="mb-3">
                <label for="harga_tiket" class="form-label">Harga Tiket (Reguler)</label>
                <input type="number" class="form-control" id="harga_tiket" name="harga_tiket" step="0.01" required>
            </div>
        <?php elseif ($tipe_bus == 'rental'): ?>
            <!-- Field tambahan untuk bus Rental -->
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa (Rental)</label>
                <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" step="0.01" required>
            </div>
        <?php endif; ?>

        <button type="submit" name="save" class="btn btn-primary">Simpan</button>
    </form>
</div>
