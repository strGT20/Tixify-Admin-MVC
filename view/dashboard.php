<h1>List Bus</h1>
<a href="?c=Bus&m=add_form" class="btn btn-primary">Tambah Bus</a>
<table>
    <thead>
    <tr>
        <th>Nomor</th>
        <th>Jenis</th>
        <th>Rute</th>
        <th>Kelas</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($buses as $bus): ?>
        <tr>
            <td><?= $bus['number'] ?></td>
            <td><?= $bus['type'] ?></td>
            <td><?= $bus['route'] ?></td>
            <td><?= $bus['class'] ?></td>
            <td><?= $bus['price'] ?></td>
            <td>
                <a href="?c=Bus&m=edit_form&id=<?= $bus['id'] ?>">Edit</a>
                <a href="?c=Bus&m=delete&id=<?= $bus['id'] ?>" onclick="return confirm('Hapus bus ini?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
