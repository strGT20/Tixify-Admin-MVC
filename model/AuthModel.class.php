<?php
class AuthModel extends Model
{
    // Ambil user berdasarkan email
    public function getUserByEmail($email) {
        $stmt = $this->mysqli->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $result = $stmt->get_result();
    }

    // Simpan data pengguna baru
    public function registerUser($nama, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();
    }
}