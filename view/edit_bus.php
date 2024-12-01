<h1>Tambah Bus</h1>
<form method="POST" action="?c=Bus&m=add_process">
    <label>Nomor Bus:</label>
    <input type="text" name="number" required>
    <label>Jenis Bus:</label>
    <select name="type">
        <option value="reguler">Reguler</option>
        <option value="rental">Rental</option>
    </select>
    <label>Rute:</label>
    <input type="text" name="route" required>
    <label>Kelas:</label>
    <input type="text" name="class" required>
    <label>Harga:</label>
    <input type="number" name="price" required>
    <button type="submit">Tambah</button>
</form>
