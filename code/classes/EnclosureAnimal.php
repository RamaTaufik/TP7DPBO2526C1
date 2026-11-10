<?php
require_once 'config/db.php';

class EnclosureAnimal {
  private $db;

  public function __construct() {
    $this->db = (new Database())->conn;
  }

  public function getAll() {
    $stmt = $this->db->prepare(
      "SELECT ae.*, e.id AS enclosure, a.name AS animal, number
       FROM enclosure_animals ae
       LEFT JOIN animals a ON ae.animal_id = a.id
       LEFT JOIN enclosures e ON ae.enclosure_id = e.id");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOne($id) {
    $stmt = $this->db->prepare(
      "SELECT ae.*, e.id AS enclosure, a.name AS animal, number
       FROM enclosure_animals ae
       LEFT JOIN animals a ON ae.animal_id = a.id
       LEFT JOIN enclosures e ON ae.enclosure_id = e.id
       WHERE ae.id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($id, $enclosure_id, $animal_id, $number) {
    $stmt = $this->db->prepare("SELECT * FROM enclosure_animals WHERE id = ?");
    $stmt->execute([$id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      flash('status', 'Duplicate ID!');
    } else {
      $crt_stmt = $this->db->prepare(
        "INSERT INTO enclosure_animals(id, enclosure_id, animal_id, `number`)
         VALUES (?, ?, ?, ?)");

      if($crt_stmt->execute([$id, $enclosure_id, $animal_id, $number])) {
        flash('status', 'Data added successfully', 'success');

        return true;
      }
    }

    return false;
  }

  public function update($target_id, $id, $enclosure_id, $animal_id, $number) {
    $stmt = $this->db->prepare("SELECT * FROM enclosure_animals WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $stmt->execute([$id]);
      $res = $stmt->fetch(PDO::FETCH_ASSOC);

      if($target_id != $id && $res) {
        flash('status', 'Duplicate ID!');
      } else {
        $upd_stmt = $this->db->prepare(
          "UPDATE enclosure_animals
           SET id = ?, enclosure_id = ?, animal_id = ?, `number` = ?
           WHERE id = ?");

        if($upd_stmt->execute([$id, $enclosure_id, $animal_id, $number, $target_id])) {
          flash('status', 'Data updated successfully', 'success');

          header("Location: ?page=enclosure-animals");
          exit();
        }
      }
    } else {
      flash('status', 'ID not found!');
    }
  }

  public function delete($target_id) {
    $stmt = $this->db->prepare("SELECT * FROM enclosure_animals WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $del_stmt = $this->db->prepare("DELETE FROM enclosure_animals WHERE id = ?");

      if($del_stmt->execute([$target_id])) {
        flash('status', 'Data deleted successfully', 'success');
      }
    } else {
      flash('status', 'ID not found!');
    }
  }
}
?>