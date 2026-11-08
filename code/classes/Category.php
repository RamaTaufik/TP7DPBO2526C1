<?php
require_once 'config/db.php';

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
}
?>