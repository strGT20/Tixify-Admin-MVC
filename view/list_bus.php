<?php
session_start();
if(!isset($_SESSION['id_user']))
    header("Location: ?c=Auth");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="/styles/style.css">
    <title>Daftar Bus</title>
</head>
<body>
<br><br><br><br>
<h1>STARLUXE FLEET CONTROL</h1>

<div class="flexbox">
    <div class="add-container" id="add">
        <div class="add-button">
            <a href="?c=Bus&m=insertFormReguler" id="btn-add">Tambah Bus Reguler</a>
            <br><br>
            <a href="?c=Bus&m=insertFormRental" id="btn-add">Tambah Bus Rental</a>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($data['bus'])): ?>
            <?php foreach ($data['bus'] as $bus): ?>
                <div class="card mb-3">
                    <div class="col-md-4">
                        <img src="<?= htmlspecialchars($bus['foto_armada']); ?>" class="img-fluid rounded-start" alt="Bus Image">
                    </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($bus['no_reg_bus']); ?></h5>
                                <p class="card-text">Kelas : <?= htmlspecialchars($bus['kelas_layanan']); ?></p>
                                <a href="?c=Bus&m=updateForm&id_bus="<?= htmlspecialchars($bus['id_bus']) ?> class="btn btn-primary">Detail</a>
                                <a href="?c=Bus&m=delete&id_bus=<?= htmlspecialchars($bus['id_bus']); ?>"
                                   class="btn btn-danger"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus bus ini?');">Hapus</a>
                            </div>
                        </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada data bus yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
