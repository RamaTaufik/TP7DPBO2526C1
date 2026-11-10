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
  } elseif($_GET['page'] == 'enclosures') {
    $upd_enclosure = $enclosure->getOne($_GET['update-id']);
  } elseif($_GET['page'] == 'enclosure-animals') {
    $upd_enclosure_animal = $enclosure_animal->getOne($_GET['update-id']);
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
if(isset($_POST['create-enclosure'])) {
  $enclosure->create(
    $_POST['sun-exposure'] ?? '',
    $_POST['vegetation'] ?? '',
    $_POST['security'] ?? '',
    $_POST['last-maintained-at'] ?? '',
    isset($_POST['size-null']) ? '__null__' : ($_POST['size'] ?? ''),
    $_POST['water-level'] ?? '',
    $_POST['water-type'] ?? '',
    $_POST['is-indoor'] ?? '',
    $_POST['id'],
    $_POST['status']
  );
} elseif(isset($_POST['delete-enclosure'])) {
  $enclosure->delete($_POST['id']);
} elseif(isset($_POST['update-enclosure'])) {
  $enclosure->update(
    $_GET['update-id'],
    $_POST['sun-exposure'] ?? '',
    $_POST['vegetation'] ?? '',
    $_POST['security'] ?? '',
    $_POST['last-maintained-at'] ?? '',
    isset($_POST['size-null']) ? '__null__' : ($_POST['size'] ?? ''),
    $_POST['water-level'] ?? '',
    $_POST['water-type'] ?? '',
    $_POST['is-indoor'] ?? '',
    $_POST['id'],
    $_POST['status']
  );
}
if(isset($_POST['create-enclosure-animal'])) {
  $enclosure_animal->create($_POST['id'], $_POST['enclosure_id'], $_POST['animal_id'], $_POST['number']);
} elseif(isset($_POST['delete-enclosure-animal'])) {
  $enclosure_animal->delete($_POST['id']);
} elseif(isset($_POST['update-enclosure-animal'])) {
  $enclosure_animal->update(
    $_GET['update-id'],
    $_POST['id'],
    $_POST['enclosure_id'],
    $_POST['animal_id'],
    $_POST['number']
  );
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
      <a href="?page=enclosure-animals">Animals in Enclosures</a>
    </nav>

    <?php
    if(isset($_GET['page'])) {
      $page = $_GET['page'];

      if($page == 'categories') include 'views/categories.php';
      elseif($page == 'animals') include 'views/animals.php';
      elseif($page == 'enclosures') include 'views/enclosures.php';
      elseif($page == 'enclosure-animals') include 'views/enclosure-animals.php';
    }
    ?>
  </main>
  <?php include 'views/footer.php'; ?>
</body>
</html>