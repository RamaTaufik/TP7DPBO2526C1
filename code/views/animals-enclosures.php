<h3 class="title">Add Animal Enclosure Placement</h3>
<form method="POST">
  <label>Animal</label>
  <select name="animal_id" required>
    <option value="" selected disabled hidden>Choose animal</option>
    <?php foreach($animal->getAll() as $a) {?>
    <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
    <?php } ?>
  </select>
  <label>Enclosure</label>
  <select name="enclosure_id" required>
    <option value="" selected disabled hidden>Choose enclosure</option>
    <?php foreach($enclosure->getAll() as $e) {?>
    <option value="<?= $e['id'] ?>"><?= $e['id'] ?></option>
    <?php } ?>
  </select>
  <label>Animal Number</label>
  <input type="number" name="number" id="number">
  <button type="submit" name="create-enclosure_animal">Create</button>
</form>

<h3 class="title">Animal Enclosure Placement List</h3>
<table border="1">
  <tr>
    <th>Enclosure</th>
    <th>Animal</th>
    <th>Animal Number</th>
    <th>Action</th>
  </tr>
  <?php 
    $enclosure_animals = $enclosure_animal->getAll();

    foreach($enclosure_animals as $ae) {
  ?>
  <tr>
    <td><?= $ae['enclosure'] ?></td>
    <td><?= $ae['animal'] ?></td>
    <td><?= $ae['number'] ?></td>
    <td>
      <!-- <a href="?page=animals&return=<?= $ae['id'] ?>">Return</a> -->
    </td>
  </tr>
  <?php } ?>
</table>