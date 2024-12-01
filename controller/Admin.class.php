<?php
class Admin extends Controller
{
    public function index()
    {
        $this->loadView('login');
    }

    public function login_process()
    {
        $adminModel = $this->loadModel('AdminModel');
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($adminModel->verifyLogin($email, $password)) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: ?c=Bus&m=list");
        } else {
            $this->loadView('login', ['error' => 'Login gagal!']);
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?c=Admin");
    }
}
