<?php
class Auth extends Controller
{
    public function index()
    {
        $this->loadView('login');
    }

    // Menampilkan form login
//    public function login_form()
//    {
//        $this->loadView('login');
//    }

    public function register()
    {
        $this->loadView('register');
    }

    // Proses login
    public function loginProcess()
    {
        $email = addslashes($_POST['email']);
        $password = addslashes($_POST['password']);
        $admin = addslashes($_POST['is_admin']);
        $authModel = $this->loadModel('AuthModel');
        $users = $authModel->getUsers($email, $password);

        if ($users->num_rows != 0) {
            $row = $users->fetch_assoc();
            if ($users && password_verify($password, $users['password'])) {
                session_start();
                $_SESSION['user_id'] = $users['id'];
                $_SESSION['name'] = $users['name'];
                $_SESSION['is_admin'] = $users['is_admin'];
//            header('Location: ?c=Auth&m=index');
                if ($users['is_admin']) {
                    header("Location: ?c=Bus&m=BusModel");
                } else {
                    header("Location: ?c=Auth&m=index");
                }
                exit();

            } else {
                return ['error' => 'Email atau kata sandi salah!'];
            }
        }
    }

    // Proses register
    public function registerProcess()
    {
        $userModel = $this->loadModel('AuthModel');
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userModel->registerUser($name, $email, $password);
        header('Location: ?c=Auth&m=loginProcess');
    }

    // Dashboard setelah login
//    public function dashboard()
//    {
//        session_start();
//        if (!isset($_SESSION['user_id'])) {
//            header('Location: ?c=Auth&m=loginProcess');
//            exit;
//        }
//        $this->loadView('list_bus', ['name' => $_SESSION['name']]);
//    }

    // Logout
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ?c=Auth&m=loginProcess');
    }
}