<h3 class="title">Add Animal</h3>
<form method="POST">
  <label>ID</label>
  <input type="text" name="id" id="id">
  <label>Category</label>
  <select name="category_id">
  </select>
  <button type="submit" name="create-animal">Create</button>
</form>

<h3 class="title">Animal List</h3>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Scientific Name</th>
    <th>Description</th>
    <th>Category</th>
    <th>Action</th>
  </tr>
  <?php 
    $animals = $animal->getAll();

    foreach($animals as $a) {
  ?>
  <tr>
    <td><?= $a['id'] ?></td>
    <td><?= $a['name'] ?></td>
    <td><?= $a['scientific_name'] ?></td>
    <td><?= $a['desc'] ?></td>
    <td><?= $a['category'] ?? 'Not Returned' ?></td>
    <td>
      <!-- <a href="?page=animals&return=<?= $a['id'] ?>">Return</a> -->
    </td>
  </tr>
  <?php } ?>
</table>