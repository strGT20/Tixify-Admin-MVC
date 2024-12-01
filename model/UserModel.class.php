<?php
class UserModel extends Model
{
    // Ambil data pengguna berdasarkan email
    public function __construct($connect) {
        $this->connect = $connect;
    }

    // Ambil user berdasarkan email
    public function getUserByEmail($email) {
        $stmt = $this->connect->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Simpan data pengguna baru
    public function registerUser($name, $email, $password)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        return $stmt->execute();
    }
}