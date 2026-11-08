<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Zoo Management</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'view/header.php'; ?>
  <main>
    <h2>Welcome to Zoo Management System</h2>
    <nav>
      <a href="?page=categories">Categories</a> |
      <a href="?page=animals">Animals</a> |
      <a href="?page=enclosures">Enclosures</a> |
      <a href="?page=animals-enclosures">Animals in Enclosures</a>
    </nav>

    <?php
    if(isset($_GET['page'])) {
      $page = $_GET['page'];

      if($page == 'categories') include 'view/categories.php';
      elseif($page == 'animals') include 'view/animals.php';
      elseif($page == 'enclosures') include 'view/enclosures.php';
      elseif($page == 'animals-enclosures') include 'view/animals-enclosures.php';
    }
    ?>
  </main>
  <?php include 'view/footer.php'; ?>
</body>
</html>