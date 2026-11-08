<h3 class="title">Add Category</h3>
<form method="POST">
  <label>ID</label>
  <input type="text" name="id" id="id">
  <label>Name</label>
  <input type="text" name="name" id="name">
  <button type="submit" name="create-category">Create</button>
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
      <!-- <a href="?page=animals&return=<?= $c['id'] ?>">Return</a> -->
    </td>
  </tr>
  <?php } ?>
</table>