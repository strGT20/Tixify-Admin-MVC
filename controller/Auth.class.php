<?php
class Auth extends Controller
{
    public function index()
    {
        $this->loadView('login');
    }

    public function register()
    {
        $this->loadView('register');
    }

    // Proses login
    public function loginProcess()
    {

        // Validasi input
        $email = $_POST['email'];
        $password = $_POST['password'];

        $authModel = $this->loadModel('AuthModel');
        $user = $authModel->getUserByEmail($email); // Mengambil data user sebagai array

        // Cek apakah pengguna ditemukan
        if ($user->num_rows > 0) {
            $row = $user->fetch_assoc();
            // Validasi password
            if (password_verify($password, $row['password'])) {
                $_SESSION['id_user'] = $row['id_user'];
                header("Location: ?c=Bus&m=index");
            } else {
                die("Password salah.");
            }
        } else {
            die("Pengguna tidak ditemukan.");
        }
    }


    // Proses register
    public function registerProcess()
    {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
            die("Semua field harus diisi.");
        }

        $userModel = $this->loadModel('AuthModel');
        $name = htmlspecialchars(trim($_POST['nama']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userModel->registerUser($name, $email, $password);
        header('Location: ?c=Auth&m=index');
    }

    // Logout
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ?c=Auth');
    }
}