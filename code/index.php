<?php
require_once 'classes/Category.php';
require_once 'classes/Animal.php';
require_once 'classes/Enclosure.php';
require_once 'classes/EnclosureAnimal.php';
require_once 'helpers.php';

$category = new Category();
$animal = new Animal();
$enclosure = new Enclosure();
$enclosure_animal = new EnclosureAnimal();

if(isset($_GET['update-id'])) {
  if($_GET['page'] == 'categories') {
    $upd_category = $category->getOne($_GET['update-id']);
  } elseif($_GET['page'] == 'animals') {
    $upd_animal = $animal->getOne($_GET['update-id']);
  }
}

if(isset($_POST['create-category'])) {
  $category->create($_POST['id'], $_POST['name']);
} elseif(isset($_POST['delete-category'])) {
  $category->delete($_POST['id']);
} elseif(isset($_POST['update-category'])) {
  $category->update($_GET['update-id'], $_POST['id'], $_POST['name']);
}
if(isset($_POST['create-animal'])) {
  $animal->create($_POST['id'], $_POST['name'], $_POST['scientific-name'], $_POST['category-id'], $_POST['desc']);
} elseif(isset($_POST['delete-animal'])) {
  $animal->delete($_POST['id']);
} elseif(isset($_POST['update-animal'])) {
  $animal->update($_GET['update-id'], $_POST['id'], $_POST['name'], $_POST['scientific-name'], $_POST['category-id'], $_POST['desc']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Zoo Management</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
  $e = flash('status');

  if($e != NULL) {
  ?>
  <div class="alert alert-<?= $e['type'] ?>" onclick="this.style.display = 'none'">
    <h3 class="text-<?= $e['type'] ?>"><?= strtoupper($e['type']) ?></h3>
    <?= $e['message'] ?>
  </div>
  <?php } ?>
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