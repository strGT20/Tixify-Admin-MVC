<?php
class AdminModel extends Model
{
    public function verifyLogin($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $this->mysqli->query($sql);
        return $result->num_rows > 0;
    }
}
