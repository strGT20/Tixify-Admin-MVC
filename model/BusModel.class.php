<?php
class BusModel extends Model
{
    public function getAllBuses()
    {
        $sql = "SELECT * FROM buses";
        return $this->mysqli->query($sql);
    }

    public function getBusById($id)
    {
        $sql = "SELECT * FROM buses WHERE id = $id";
        return $this->mysqli->query($sql)->fetch_assoc();
    }

    public function insertBus($name, $type, $capacity)
    {
        $sql = "INSERT INTO buses (name, type, capacity) VALUES ('$name', '$type', '$capacity')";
        $this->mysqli->query($sql);
    }

    public function updateBus($id, $name, $type, $capacity)
    {
        $sql = "UPDATE buses SET name = '$name', type = '$type', capacity = '$capacity' WHERE id = $id";
        $this->mysqli->query($sql);
    }

    public function deleteBus($id)
    {
        $sql = "DELETE FROM buses WHERE id = $id";
        $this->mysqli->query($sql);
    }
}
