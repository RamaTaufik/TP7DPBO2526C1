<h3 class="title">Add Animal Enclosure Placement</h3>
<form method="POST" class="input-form">
  <label>ID</label>
  <input type="number" name="id" id="id" min="1" value="<?= isset($upd_enclosure_animal)? htmlspecialchars($upd_enclosure_animal['id'], ENT_QUOTES, 'UTF-8'): '' ?>" required>
  <label>Animal</label>
  <select name="animal_id" required>
    <option value="" <?= isset($upd_enclosure_animal)? '': 'selected' ?> disabled hidden>Choose animal</option>
    <?php foreach($animal->getAll() as $a) {?>
    <option value="<?= htmlspecialchars($a['id'], ENT_QUOTES, 'UTF-8') ?>" <?= isset($upd_enclosure_animal) && $upd_enclosure_animal['animal_id'] == $a['id']? 'selected': '' ?>><?= htmlspecialchars($a['name'], ENT_QUOTES, 'UTF-8') ?></option>
    <?php } ?>
  </select>
  <label>Enclosure</label>
  <select name="enclosure_id" required>
    <option value="" <?= isset($upd_enclosure_animal)? '': 'selected' ?> disabled hidden>Choose enclosure</option>
    <?php foreach($enclosure->getAll() as $e) {?>
    <option value="<?= htmlspecialchars($e['id'], ENT_QUOTES, 'UTF-8') ?>" <?= isset($upd_enclosure_animal) && $upd_enclosure_animal['enclosure_id'] == $e['id']? 'selected': '' ?>><?= htmlspecialchars($e['id'], ENT_QUOTES, 'UTF-8') ?></option>
    <?php } ?>
  </select>
  <label>Animal Number</label>
  <input type="number" name="number" id="number" min="0" value="<?= isset($upd_enclosure_animal)? htmlspecialchars($upd_enclosure_animal['number'], ENT_QUOTES, 'UTF-8'): '0' ?>" required>
  <button type="submit" name="<?= isset($_GET['update-id'])? 'update': 'create' ?>-enclosure-animal">Submit</button>
</form>

<h3 class="title">Animal Enclosure Placement List</h3>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Enclosure</th>
    <th>Animal</th>
    <th>Amount</th>
    <th>Action</th>
  </tr>
  <?php 
    $enclosure_animals = $enclosure_animal->getAll();

    foreach($enclosure_animals as $ae) {
  ?>
  <tr>
    <td><?= $ae['id'] ?></td>
    <td><?= $ae['enclosure'] ?></td>
    <td><?= $ae['animal'] ?></td>
    <td><?= $ae['number'] ?></td>
    <td>
      <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($ae['id'], ENT_QUOTES, 'UTF-8') ?>">
        <a href="?page=enclosure-animals&update-id=<?= urlencode($ae['id']) ?>" class="btn btn-warning">Update</a>
        <button type="submit" class="btn-danger" name="delete-enclosure-animal" onclick="return confirm('Delete animal placement?')">Delete</button>
      </form>
    </td>
  </tr>
  <?php } ?>
</table>