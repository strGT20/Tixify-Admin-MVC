<?php
class Bus extends Controller
{
    public function index()
    {
        $busModel = $this->loadModel('BusModel');
        $bus = $busModel->getAllBuses();
        $this->loadView('list_bus', ['bus' => $bus]);
    }
    
    public function getAllBuses()
    {
        $busModel = $this->loadModel('BusModel');
        $bus = $busModel->getAllBuses();
        while ($row = $bus->fetch_assoc()) {
            echo $row['no_reg_bus']; // Tampilkan data bus
        }
    }

    private function imagesUploadHandler(): string
    {
        // Periksa apakah file diunggah
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Tentukan direktori tujuan
            $target_dir = "images/" . basename($_FILES['image']['name']);

            if($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                echo "<script>alert('File upload error: " . $_FILES['image']['error'] . "');</script>";
                echo "<script>window.location.href = '?c=Bus';</script>";
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_dir)) {
                echo "<script>alert('An error occurred, please try again!');</script>";
                echo "<script>window.location.href = '?c=Bus';</script>";
            }
            // Return path file yang berhasil diupload
            return $target_dir;
        }
        // Jika tidak ada file yang diunggah
        return "";
    }

    // Method untuk memanggil view insert_bus
    public function insertFormReguler()
    {
        $this->loadView('insert_bus_reguler');
    }

    public function insertFormRental() 
    {
        $this->loadView('insert_bus_rental');
    }

    //Method untuk menjalankan logika insert
    public function insertBusReguler()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipe_bus = $_POST['tipe_bus'];
            $no_reg_bus = $_POST['no_reg_bus'];
            $kelas_layanan = $_POST['kelas_layanan'];
            $kapasitas = $_POST['kapasitas'];
            $rute = $_POST['rute'];
            $harga_tiket = $_POST['harga_tiket'];

            // Proses upload file
            $foto_armada = $this->imagesUploadHandler();
            if (empty($foto_armada === null)) {
                $foto_armada = 'images/jetbus_mhd5.jpg';
            }

            // Simpan data ke tabel bus
            $busModel = $this->loadModel('BusModel');
            $id_bus = $busModel->insertBus($no_reg_bus, $tipe_bus, $kelas_layanan, $kapasitas, $foto_armada);

            if ($id_bus) {
                // Simpan data ke tabel bus_reguler
                $result = $busModel->insertBusReguler($id_bus, $rute, $harga_tiket);
                if ($result) {
                    header("Location: ?c=Bus&m=index");
                    exit();
                }
            }

            die("Gagal menyimpan data bus reguler.");
        }
    }


    public function insertBusRental()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipe_bus = $_POST['tipe_bus'];
            $no_reg_bus = $_POST['no_reg_bus'];
            $kelas_layanan = $_POST['kelas_layanan'];
            $kapasitas = $_POST['kapasitas'];
            $harga_sewa = $_POST['harga_sewa'];

            // Proses upload file
            $foto_armada = $this->imagesUploadHandler();
            if (empty($foto_armada === null)) {
                $foto_armada = 'images/jetbus_mhd5.jpg';
            }

            // Simpan data ke tabel bus
            $busModel = $this->loadModel('BusModel');
            $id_bus = $busModel->insertBus($no_reg_bus, $tipe_bus, $kelas_layanan, $kapasitas, $foto_armada);

            if ($id_bus) {
                // Simpan data ke tabel bus_rental
                $result = $busModel->insertBusRental($id_bus, $harga_sewa);
                if ($result) {
                    header("Location: ?c=Bus&m=index");
                    exit();
                }
            }

            die("Gagal menyimpan data bus rental.");
        }
    }

    public function updateForm()
    {
        $this->loadView('update_bus');
    }

    public function update($id, $bus)
    {
        $busModel = $this->model('BusModel');
        $this->loadView('edit_bus', ['bus' => $bus]);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'no_reg_bus' => $_POST['no_reg_bus'],
                'kelas_layanan' => $_POST['kelas_layanan'],
                'kapasitas' => $_POST['kapasitas'],
                'tipe_bus' => $_POST['tipe_bus'],
                'image' => $_FILES['image']['name'], // Pastikan upload file berhasil
            ];

            // Tambahkan data spesifik berdasarkan tipe bus
            if ($_POST['tipe_bus'] == 'reguler') {
                $data['rute'] = $_POST['rute'];
                $data['harga_tiket'] = $_POST['harga_tiket'];
            } elseif ($_POST['tipe_bus'] == 'rental') {
                $data['harga_sewa'] = $_POST['harga_sewa'];
            }

            // Update data
            $busModel->updateBus($id, $data);
            header('Location: ?c=Bus');
            exit;
        }
    }

    public function delete()
    {
        if (isset($_GET['id_bus'])) {
            $id_bus = $_GET['id_bus'];

            // Load model
            $busModel = $this->loadModel('BusModel');

            // Validasi apakah bus dengan ID tersebut ada
            $bus = $busModel->getBusById($id_bus);
            if ($bus) {
                // Hapus data
                $busModel->deleteBus($id_bus);
                // Redirect ke halaman utama
                header("Location: ?c=Bus&success=" . urlencode("Bus berhasil dihapus"));
            } else {
                // Redirect dengan pesan error jika ID tidak valid
                header("Location: ?c=Bus&error=" . urlencode("Bus tidak ditemukan"));
            }
        } else {
            // Redirect jika ID tidak diberikan
            header("Location: ?c=Bus&error=" . urlencode("ID tidak diberikan"));
        }
        exit;
    }
}
