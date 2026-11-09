<?php
require_once 'config/db.php';
require_once 'helpers.php';

class Category {
  private $db;

  public function __construct() {
    $this->db = (new Database())->conn;
  }

  public function getAll() {
    $stmt = $this->db->prepare("SELECT * FROM categories");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOne($id) {
    $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($id, $name) {
    $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      flash('status', 'Duplicate ID!');
    } else {
      $crt_stmt = $this->db->prepare("INSERT INTO categories(id, `name`) VALUES (?, ?)");
      flash('status', 'Data added successfully', 'success');

      return $crt_stmt->execute([$id, $name]);
    }
  }

  public function update($target_id, $id, $name) {
    $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $stmt->execute([$id]);
      $res = $stmt->fetch(PDO::FETCH_ASSOC);

      if($target_id != $id && $res) {
        flash('status', 'Duplicate ID!');
      } else {
        $upd_stmt = $this->db->prepare("UPDATE categories SET id = ?, `name` = ? WHERE id = ?");
        
        if($upd_stmt->execute([$id, $name, $target_id])) {
          flash('status', 'Data updated successfully', 'success');

          header("Location: ?page=categories");
          exit();
        }
      }
    } else {
      flash('status', 'ID not found!');
    }
  }

  public function delete($target_id) {
    $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $del_stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");

      if($del_stmt->execute([$target_id])) {
        flash('status', 'Data deleted successfully', 'success');
      }
    } else {
      flash('status', 'ID not found!');
    }
  }
}
?>