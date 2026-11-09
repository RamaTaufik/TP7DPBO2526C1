<h3 class="title">Add Animal</h3>
<form method="POST" class="input-form">
  <label>ID</label>
  <input type="text" name="id" id="id" <?= isset($upd_animal)? 'value="'.$upd_animal["id"].'"': '' ?> required>
  <label>Name</label>
  <input type="text" name="name" id="name" <?= isset($upd_animal)? 'value="'.$upd_animal["name"].'"': '' ?> required>
  <label>Scientific Name</label>
  <input type="text" name="scientific-name" id="scientific-name" <?= isset($upd_animal)? 'value="'.$upd_animal["scientific_name"].'"': '' ?> required>
  <label>Description</label>
  <textarea name="desc" id="desc"><?= isset($upd_animal)? $upd_animal["desc"]: '' ?></textarea>
  <label>Category</label>
  <select name="category-id" required>
    <option value="" <?= isset($upd_animal)? '': 'selected' ?> disabled hidden>Choose category</option>
    <?php foreach($category->getAll() as $c) {?>
    <option value="<?= $c['id'] ?>" <?= isset($upd_animal) && $upd_animal['category_id'] == $c['id']? 'selected': '' ?>><?= $c['name'] ?></option>
    <?php } ?>
  </select>
  <button type="submit" name="<?=  isset($_GET['update-id'])? 'update': 'create' ?>-animal">Submit</button>
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
    <td><?= $a['desc'] ?? '-' ?></td>
    <td><?= $a['category']?></td>
    <td>
      <form method="POST">
        <input type="hidden" name="id" value="<?= $a['id'] ?>">
        <a href="?page=animals&update-id=<?= $a['id'] ?>" class="btn btn-warning">Update</a>
        <button type="submit" class="btn-danger" name="delete-animal" onclick="return confirm('Delete animal <?= $a['name'] ?>?')">Delete</button>
      </form>
    </td>
  </tr>
  <?php } ?>
</table>