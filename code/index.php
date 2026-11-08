<?php
require_once 'classes/Category.php';
require_once 'classes/Animal.php';
require_once 'classes/Enclosure.php';
require_once 'classes/EnclosureAnimal.php';

$category = new Category();
$animal = new Animal();
$enclosure = new Enclosure();
$enclosure_animal = new EnclosureAnimal();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Zoo Management</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'views/header.php'; ?>
  <main>
    <h2>Welcome to Zoo Management System</h2>
    <nav>
      <a href="?page=categories">Categories</a><span>|</span>
      <a href="?page=animals">Animals</a><span>|</span>
      <a href="?page=enclosures">Enclosures</a><span>|</span>
      <a href="?page=animals-enclosures">Animals in Enclosures</a>
    </nav>

    <?php
    if(isset($_GET['page'])) {
      $page = $_GET['page'];

      if($page == 'categories') include 'views/categories.php';
      elseif($page == 'animals') include 'views/animals.php';
      elseif($page == 'enclosures') include 'views/enclosures.php';
      elseif($page == 'animals-enclosures') include 'views/animals-enclosures.php';
    }
    ?>
  </main>
  <?php include 'views/footer.php'; ?>
</body>
</html>