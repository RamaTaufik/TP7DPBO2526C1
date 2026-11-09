<h3 class="title">Add Category</h3>
<form method="POST" class="input-form">
  <label>ID</label>
  <input type="number" name="id" id="id" <?= isset($upd_category)? 'value="'.$upd_category["id"].'"': '' ?> required>
  <label>Name</label>
  <input type="text" name="name" id="name" <?= isset($upd_category)? 'value="'.$upd_category["name"].'"': '' ?> required>
  <button type="submit" name="<?=  isset($_GET['update-id'])? 'update': 'create' ?>-category">Create</button>
</form>

<h3 class="title">Category List</h3>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Action</th>
  </tr>
  <?php 
    $categories = $category->getAll();

    foreach($categories as $c) {
  ?>
  <tr>
    <td><?= $c['id'] ?></td>
    <td><?= $c['name'] ?></td>
    <td>
      <form method="POST">
        <input type="hidden" name="id" value="<?= $c['id'] ?>">
        <a href="?page=categories&update-id=<?= $c['id'] ?>" class="btn btn-warning">Update</a>
        <button type="submit" class="btn-danger" name="delete-category" onclick="return confirm('Delete category <?= $c['name'] ?>?')">Delete</button>
      </form>
    </td>
  </tr>
  <?php } ?>
</table>