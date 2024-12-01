<?php
class BusModel extends Model
{
    public function insertBus($name, $type, $capacity)
    {
        $sql = "INSERT INTO buses (name, type, capacity) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssi", $name, $type, $capacity);
        $stmt->execute();
    }

    public function getAllBuses()
    {
        $sql = "SELECT * FROM buses";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getBusById($id)
    {
        $sql = "SELECT * FROM buses WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateBus($id, $name, $type, $capacity)
    {
        $sql = "UPDATE buses SET name = ?, type = ?, capacity = ? WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssii", $name, $type, $capacity, $id);
        return $stmt->execute();
    }

    public function deleteBus($id)
    {
        $sql = "DELETE FROM buses WHERE id = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
