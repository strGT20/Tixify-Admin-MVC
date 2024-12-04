<div class="container">
    <h1>Edit Data Bus</h1>
    <form action="?c=Bus&m=update_process" method="post" enctype="multipart/form-data">
        <!-- Input hidden untuk ID -->
        <input type="hidden" name="id_bus" value="<?= $data['bus']['id_bus'] ?>">

        <!-- Dropdown buat pilih tipe bus -->
        <div class="mb-3">
            <label for="tipe_bus" class="form-label">Tipe Bus</label>
            <select class="form-control" id="tipe_bus" name="tipe_bus" required>
                <option value="reguler" <?= $data['bus']['tipe_bus'] === 'reguler' ? 'selected' : '' ?>>Reguler</option>
                <option value="rental" <?= $data['bus']['tipe_bus'] === 'rental' ? 'selected' : '' ?>>Rental</option>
            </select>
        </div>

        <!-- Input data umum -->
        <div class="mb-3">
            <label for="no_reg_bus" class="form-label">Nomor Registrasi Bus</label>
            <input type="text" class="form-control" id="no_reg_bus" name="no_reg_bus" value="<?= $data['bus']['no_reg_bus'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="kelas_layanan" class="form-label">Kelas Layanan</label>
            <select class="form-control" id="kelas_layanan" name="kelas_layanan" required>
                <option value="Executive" <?= $data['bus']['kelas'] === 'Executive' ? 'selected' : '' ?>>Executive</option>
                <option value="Super Executive" <?= $data['bus']['kelas'] === 'Super Executive' ? 'selected' : '' ?>>Super Executive</option>
                <!-- Tambahkan opsi lainnya -->
            </select>
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="<?= $data['bus']['kapasitas'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Foto Armada</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="<?= $data['bus']['foto_armada'] ?>" alt="Bus Image" width="100">
        </div>

        <!-- Field tambahan -->
        <?php if ($data['bus']['tipe_bus'] === 'reguler'): ?>
            <div class="mb-3">
                <label for="rute" class="form-label">Rute</label>
                <input type="text" class="form-control" id="rute" name="rute" value="<?= $data['bus']['rute'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="harga-tiket" class="form-label">Harga Tiket</label>
                <input type="number" class="form-control" id="harga-tiket" name="harga-tiket" value="<?= $data['bus']['harga_tiket'] ?>" required>
            </div>
        <?php elseif ($data['bus']['tipe_bus'] === 'rental'): ?>
            <div class="mb-3">
                <label for="harga-sewa" class="form-label">Harga Sewa</label>
                <input type="number" class="form-control" id="harga-sewa" name="harga-sewa" value="<?= $data['bus']['harga_sewa'] ?>" required>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
