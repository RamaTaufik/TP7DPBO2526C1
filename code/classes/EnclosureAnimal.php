<?php
require_once 'config/db.php';

class EnclosureAnimal {
  private $db;

  public function __construct() {
    $this->db = (new Database())->conn;
  }

  public function getAll() {
    $stmt = $this->db->prepare(
      "SELECT e.id AS enclosure, a.name AS animal, number
       FROM enclosure_animals ae
       LEFT JOIN animals a ON ae.animal_id = a.id
       LEFT JOIN enclosures e ON ae.enclosure_id = e.id");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>