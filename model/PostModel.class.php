<?php
class PostModel extends Model
{
    public function getAll()
    {
        $sql = 'SELECT * FROM post ORDER BY id DESC';
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function insert($title, $content)
    {
        $sql = "INSERT INTO post (title, content) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('ss', $title, $content); // 'ss' -> 2 string parameters
        $stmt->execute();
    }

    public function getById($id)
     {
          $sql = "SELECT * FROM post WHERE id = ?";
          $stmt = $this->mysqli->prepare($sql);
          $stmt->bind_param('i', $id);
          $stmt->execute();
          return $stmt->get_result();
     }
     public function update($id, $title, $content)
     {
          $sql = "UPDATE post SET title = ?, content = ? WHERE id = ?";
          $stmt = $this->mysqli->prepare($sql);
          $stmt->bind_param('ssi', $title, $content, $id);
          $stmt->execute();
     }

     public function delete($id)
     {
          $sql = "DELETE FROM post WHERE id = ?";
          $stmt = $this->mysqli->prepare($sql);
          $stmt->bind_param('i', $id);
          $stmt->execute();
     }
}