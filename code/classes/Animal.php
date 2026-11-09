<?php
require_once 'config/db.php';

class Animal {
  private $db;

  public function __construct() {
    $this->db = (new Database())->conn;
  }

  public function getAll() {
    $stmt = $this->db->prepare(
      "SELECT a.*, c.name AS category
       FROM animals a
       LEFT JOIN categories c ON a.category_id = c.id");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOne($id) {
    $stmt = $this->db->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($id, $name, $scientific_name, $category_id, $desc = '') {
    $stmt = $this->db->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->execute([$id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      flash('status', 'Duplicate ID!');
    } else {
      $crt_stmt = $this->db->prepare("INSERT INTO animals(id, `name`, scientific_name, `desc`, category_id) VALUES (?, ?, ?, ?, ?)");
      flash('status', 'Data added successfully', 'success');

      return $crt_stmt->execute([$id, $name, $scientific_name, $desc == NULL || $desc == '' ? NULL: $desc, $category_id]);
    }
  }

  public function update($target_id, $id, $name, $scientific_name, $category_id, $desc = '') {
    $stmt = $this->db->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $stmt->execute([$id]);
      $res = $stmt->fetch(PDO::FETCH_ASSOC);

      if($target_id != $id && $res) {
        flash('status', 'Duplicate ID!');
      } else {
        $upd_stmt = $this->db->prepare("UPDATE animals SET id = ?, `name` = ?, scientific_name = ?, `desc` = ?, category_id = ? WHERE id = ?");
        
        if($upd_stmt->execute([$id, $name, $scientific_name, $desc == NULL || $desc == '' ? NULL: $desc, $category_id, $target_id])) {
          flash('status', 'Data updated successfully', 'success');

          header("Location: ?page=animals");
          exit();
        }
      }
    } else {
      flash('status', 'ID not found!');
    }
  }

  public function delete($target_id) {
    $stmt = $this->db->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $del_stmt = $this->db->prepare("DELETE FROM animals WHERE id = ?");

      if($del_stmt->execute([$target_id])) {
        flash('status', 'Data deleted successfully', 'success');
      }
    } else {
      flash('status', 'ID not found!');
    }
  }
}
?>