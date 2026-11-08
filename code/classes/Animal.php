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
}
?>