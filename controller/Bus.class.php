<?php
class Bus extends Controller
{
    public function index()
    {
        $busModel = $this->loadModel('BusModel');
        $buses = $busModel->getAllBuses();
        $this->loadView('list_bus', ['buses' => $buses]);
    }
    
    public function getAllBuses()
    {
        $busModel = $this->loadModel('BusModel');
        $buses = $busModel->getAllBuses();
        while ($bus = $buses->fetch_assoc()) {
            echo $bus['name']; // Tampilkan data bus
        }
    }

    private function imagesUploadHandler(): string
    {
        // Periksa apakah file diunggah
        if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Tentukan direktori tujuan
            $target_dir = "/images/" . basename($_FILES['image']['name']);

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
    public function insert_form()
    {
        $tipe_bus = $_GET['tipe'] ?? null;
        $this->loadView('insert_bus', ['tipe_bus' => $tipe_bus]);
    }


    //Method untuk menjalankan logika insert
    public function insert()
    {
        if (isset($_POST['save'])) { // Proses hanya jika tombol Simpan ditekan
            $tipe_bus = $_POST['tipe_bus'];
            $no_reg_bus = $_POST['no_reg_bus'];
            $kelas_layanan = $_POST['kelas_layanan'];
            $kapasitas = $_POST['kapasitas'];
            $image = $_FILES['image'];

            // Lakukan validasi input (opsional)

            // Proses field khusus sesuai tipe bus
            if ($tipe_bus === 'reguler') {
                $rute = $_POST['rute'];
                $harga_tiket = $_POST['harga_tiket'];

                // Simpan data bus reguler ke database
                $busModel = $this->loadModel('BusModel');
                $busModel->insertReguler($no_reg_bus, $kelas_layanan, $kapasitas, $image, $rute, $harga_tiket);
            } elseif ($tipe_bus === 'rental') {
                $harga_sewa = $_POST['harga_sewa'];

                // Simpan data bus rental ke database
                $busModel = $this->loadModel('BusModel');
                $busModel->insertRental($no_reg_bus, $kelas_layanan, $kapasitas, $image, $harga_sewa);
            }

            // Redirect setelah insert
            header("Location: ?c=Bus&success=Bus berhasil ditambahkan");
            exit;
        } else {
            // Jika form tidak lengkap, redirect dengan pesan error
            header("Location: ?c=Bus&error=Form tidak lengkap");
            exit;
        }
    }



    public function update_form()
    {
        $this->loadView('update_bus');
    }

    public function tipeBusReloadOnChange($id)
    {
        $busModel = $this->loadModel('BusModel');
        $bus = $busModel->getBusById($id);

        // Cek apakah tipe bus diubah
        $tipe_bus = $_POST['tipe_bus'] ?? $bus['tipe_bus'];

        // Pass data ke view
        $this->view('update_bus', ['bus' => $bus, 'tipe_bus' => $tipe_bus]);
    }

    public function update($id)
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

    public function update_process()
    {
        $id_bus = addslashes($_POST['id_bus']);
        $no_reg_bus = addslashes($_POST['no_reg_bus']);
        $kelas_layanan = addslashes($_POST['kelas_layanan']);
        $tipe_bus = addslashes($_POST['tipe_bus']);
        $kapasitas = addslashes($_POST['kapasitas']);
        $rute = addslashes($_POST['rute']);
        $harga_tiket = addslashes($_POST['harga_tiket']);
        $harga_sewa = addslashes($_POST['harga_sewa']);

        $busModel = $this->loadModel('BusModel');
        $bus = $busModel->getBusById($id_bus);

        if ($busModel->updateBus($id_bus, $no_reg_bus, $tipe_bus, $kapasitas)) {
            header("Location: ?c=Bus&m=list");
        } else {
            echo "Failed to update bus. Please try again.";
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
