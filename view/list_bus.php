<a href="?c=Bus&m=add_form">Tambah Bus</a>
<table>
    <tr><th>Nama</th><th>Tipe</th><th>Kapasitas</th><th>Aksi</th></tr>
    <?php foreach ($buses as $bus): ?>
        <tr>
            <td><?= $bus['name'] ?></td>
            <td><?= $bus['type'] ?></td>
            <td><?= $bus['capacity'] ?></td>
            <td>
                <a href="?c=Bus&m=edit_form&id=<?= $bus['id'] ?>">Edit</a>
                <form action="?c=Bus&m=delete" method="POST">
                    <input type="hidden" name="id" value="<?= $bus['id'] ?>">
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
