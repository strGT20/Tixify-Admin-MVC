<div class="container mt-5">
    <h1>Edit Data Bus</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label for="no_reg_bus" class="form-label">Nomor Registrasi Bus</label>
            <input type="text" class="form-control" id="no_reg_bus" name="no_reg_bus" value="<?php echo $bus['no_reg_bus']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kelas_layanan" class="form-label">Kelas Layanan</label>
            <input type="text" class="form-control" id="kelas_layanan" name="kelas_layanan" value="<?php echo $bus['kelas_layanan']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="<?php echo $bus['kapasitas']; ?>" required>
        </div>

        <?php if ($bus['tipe_bus'] == 'reguler') { ?>
            <div class="mb-3">
                <label for="rute" class="form-label">Rute</label>
                <input type="text" class="form-control" id="rute" name="rute" value="<?php echo $detail_bus['rute']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="harga_tiket" class="form-label">Harga Tiket</label>
                <input type="number" class="form-control" id="harga_tiket" name="harga_tiket" step="0.01" value="<?php echo $detail_bus['harga_tiket']; ?>" required>
            </div>

        <?php } else if ($bus['tipe_bus'] == 'rental') { ?>
            <div class="mb-3">
                <label for="harga_sewa" class="form-label">Harga Sewa</label>
                <input type="number" class="form-control" id="harga_sewa" name="harga_sewa" step="0.01" value="<?php echo $detail_bus['harga_sewa']; ?>" required>
            </div>
        <?php } ?>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>