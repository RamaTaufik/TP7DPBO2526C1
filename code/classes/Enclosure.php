<?php
require_once 'config/db.php';

class Enclosure {
  private $db;

  public function __construct() {
    $this->db = (new Database())->conn;
  }

  public function getAll() {
    $stmt = $this->db->prepare("SELECT * FROM enclosures");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOne($id) {
    $stmt = $this->db->prepare("SELECT * FROM enclosures WHERE id = ?");
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($sun_exposure, $vegetation, $security, $last_maintained_at, $size, $water_level, $water_type, $is_indoor, $id, $status) {
    $stmt = $this->db->prepare("SELECT * FROM enclosures WHERE id = ?");
    $stmt->execute([$id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      flash('status', 'Duplicate ID!');
    } else {
      $crt_stmt = $this->db->prepare(
        "INSERT INTO enclosures(id, `size`, water_level, water_type, sun_exposure, vegetation, `security`, is_indoor, `status`, last_maintained_at)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

      if($crt_stmt->execute([
        $id,
        $size === '__null__' ? NULL : ($size === '' ? 0 : $size),
        $water_level === '__null__' ? NULL : ($water_level === '' ? 'none' : $water_level),
        $water_type === '__null__' ? NULL : ($water_type === '' ? 'none' : $water_type),
        $sun_exposure === '' ? NULL : $sun_exposure,
        $vegetation === '' ? NULL : $vegetation,
        $security === '' ? NULL : $security,
        $is_indoor === '__null__' ? NULL : ($is_indoor === '' ? 1 : $is_indoor),
        $status,
        $last_maintained_at === '' ? NULL : $last_maintained_at
      ])) {
        flash('status', 'Data added successfully', 'success');

        return true;
      }
    }

    return false;
  }

  public function update($target_id, $sun_exposure, $vegetation, $security, $last_maintained_at, $size, $water_level, $water_type, $is_indoor, $id, $status) {
    $stmt = $this->db->prepare("SELECT * FROM enclosures WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $stmt->execute([$id]);
      $res = $stmt->fetch(PDO::FETCH_ASSOC);

      if($target_id != $id && $res) {
        flash('status', 'Duplicate ID!');
      } else {
        $values = [
          $size === '__null__' ? NULL : ($size === '' ? 0 : $size),
          $water_level === '__null__' ? NULL : ($water_level === '' ? 'none' : $water_level),
          $water_type === '__null__' ? NULL : ($water_type === '' ? 'none' : $water_type),
          $sun_exposure === '' ? NULL : $sun_exposure,
          $vegetation === '' ? NULL : $vegetation,
          $security === '' ? NULL : $security,
          $is_indoor === '__null__' ? NULL : ($is_indoor === '' ? 1 : $is_indoor),
          $status,
          $last_maintained_at === '' ? NULL : $last_maintained_at
        ];

        if($target_id == $id) {
          $upd_stmt = $this->db->prepare(
            "UPDATE enclosures
             SET `size` = ?, water_level = ?, water_type = ?, sun_exposure = ?, vegetation = ?, `security` = ?, is_indoor = ?, `status` = ?, last_maintained_at = ?
             WHERE id = ?");
          $success = $upd_stmt->execute(array_merge($values, [$target_id]));
        } else {
          $this->db->beginTransaction();
          try {
            $crt_stmt = $this->db->prepare(
              "INSERT INTO enclosures(id, `size`, water_level, water_type, sun_exposure, vegetation, `security`, is_indoor, `status`, last_maintained_at)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $crt_stmt->execute(array_merge([$id], $values));

            $rel_stmt = $this->db->prepare("UPDATE enclosure_animals SET enclosure_id = ? WHERE enclosure_id = ?");
            $rel_stmt->execute([$id, $target_id]);

            $del_stmt = $this->db->prepare("DELETE FROM enclosures WHERE id = ?");
            $del_stmt->execute([$target_id]);
            $this->db->commit();
            $success = true;
          } catch(PDOException $e) {
            $this->db->rollBack();
            throw $e;
          }
        }

        if($success) {
          flash('status', 'Data updated successfully', 'success');

          header("Location: ?page=enclosures");
          exit();
        }
      }
    } else {
      flash('status', 'ID not found!');
    }
  }

  public function delete($target_id) {
    $stmt = $this->db->prepare("SELECT * FROM enclosures WHERE id = ?");
    $stmt->execute([$target_id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($res) {
      $this->db->beginTransaction();
      try {
        $rel_stmt = $this->db->prepare("DELETE FROM enclosure_animals WHERE enclosure_id = ?");
        $rel_stmt->execute([$target_id]);

        $del_stmt = $this->db->prepare("DELETE FROM enclosures WHERE id = ?");
        $del_stmt->execute([$target_id]);
        $this->db->commit();
        flash('status', 'Data deleted successfully', 'success');
      } catch(PDOException $e) {
        $this->db->rollBack();
        throw $e;
      }
    } else {
      flash('status', 'ID not found!');
    }
  }
}
?>