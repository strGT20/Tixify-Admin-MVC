<?php
class Auth extends Controller
{
    // Menampilkan form login
    public function login_form()
    {
        $this->loadView('login');
    }

    public function register_form()
    {
        $this->loadView('register');
    }

    // Proses login
    public function login_process()
    {
        $userModel = $this->loadModel('UserModel');
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['id_admin'] = $user['is_admin'];
            header('Location: ?c=Auth&m=dashboard');
            if ($user['is_admin']) {
                header("Location: ?c=Dashboard&m=index");
            } else {
                header("Location: ?c=Home&m=index");
            }
            exit();

        } else {
            return ['error' => 'Email atau kata sandi salah!'];
        }
    }

    // Proses register
    public function register_process()
    {
        $userModel = $this->loadModel('UserModel');
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userModel->registerUser($name, $email, $password);
        header('Location: ?c=Auth&m=login_form');
    }

    // Dashboard setelah login
    public function dashboard()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?c=Auth&m=login_form');
            exit;
        }
        $this->loadView('dashboard', ['name' => $_SESSION['name']]);
    }

    // Logout
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ?c=Auth&m=login_form');
    }
}