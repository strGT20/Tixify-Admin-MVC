<?php
class BusModel extends Model
{
    public function getAllBuses()
    {
        $sql = "SELECT * FROM Bus ORDER BY id_bus DESC";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        return $result = $stmt->get_result();
    }

    public function insertBus($no_reg_bus, $tipe_bus, $kelas_layanan, $kapasitas, $foto_armada)
    {
        $sql = "INSERT INTO bus (no_reg_bus, tipe_bus, kelas_layanan, kapasitas, foto_armada) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sssis", $no_reg_bus, $tipe_bus, $kelas_layanan, $kapasitas, $foto_armada);
        $stmt->execute();

        // Ambil ID terakhir yang di-generate
        $id_bus = $this->mysqli->insert_id;

        $stmt->close();

        return $id_bus; // Kembalikan ID bus untuk digunakan di fungsi lain
    }

    public function insertBusReguler($id_bus, $rute, $harga_tiket)
    {
        $query = "INSERT INTO bus_reguler (id_bus, rute, harga_tiket) 
              VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("isd", $id_bus, $rute, $harga_tiket); // id_bus adalah integer
        $stmt->execute();
        $stmt->close();
    }


    public function insertBusRental($id_bus, $harga_sewa)
    {
        $query = "INSERT INTO bus_rental (id_bus, harga_sewa) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("id", $id_bus, $harga_sewa);
        $stmt->execute();
    }

    public function getBusById($id_bus)
    {
        $sql = "SELECT * FROM Bus WHERE id_bus = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id_bus);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateBus($id_bus, $no_reg_bus, $tipe_bus, $kapasitas)
    {
        $sql = "UPDATE Bus SET id_bus = ?, no_reg_bus = ?, tipe_bus = ?, kapasitas = ? WHERE id_bus = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("issi", $id_bus, $no_reg_bus, $tipe_bus, $kapasitas);
        $data = $stmt->execute();
        return $data;
    }

    public function deleteBus($id_bus)
    {
        // Hapus data terkait di tabel bus_reguler
        $sqlReguler = "DELETE FROM bus_reguler WHERE id_bus = ?";
        $stmtReguler = $this->mysqli->prepare($sqlReguler);
        $stmtReguler->bind_param("i", $id_bus);
        $stmtReguler->execute();

        // Tambahkan query untuk menghapus data terkait di tabel lain jika ada
        // Contoh: Hapus data di tabel bus_rental jika ada hubungan dengan id_bus
        $sqlRental = "DELETE FROM bus_rental WHERE id_bus = ?";
        $stmtRental = $this->mysqli->prepare($sqlRental);
        $stmtRental->bind_param("i", $id_bus);
        $stmtRental->execute();

        // Setelah data terkait dihapus, hapus data di tabel bus
        $sql = "DELETE FROM bus WHERE id_bus = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id_bus);
        return $stmt->execute();
    }

}
