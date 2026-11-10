<h3 class="title"><?= isset($upd_enclosure)? 'Update': 'Add' ?> Enclosure</h3>
<form method="POST" class="input-form">
  <label>ID</label>
  <input type="text" name="id" id="id" value="<?= isset($upd_enclosure)? htmlspecialchars($upd_enclosure['id'], ENT_QUOTES, 'UTF-8'): '' ?>" required>
  <label>Size (m<sup>2</sup>)</label>
  <input type="number" name="size" id="size" min="0" value="<?= isset($upd_enclosure)? $upd_enclosure['size']: '' ?>">
  <label><input type="checkbox" name="size-null" value="1" <?= isset($upd_enclosure) && $upd_enclosure['size'] === NULL? 'checked': '' ?>> *size not specified</label>
  <label>Water Level</label>
  <select name="water-level">
    <option value="__null__" <?= isset($upd_enclosure) && $upd_enclosure['water_level'] === NULL? 'selected': '' ?>>Not specified</option>
    <?php foreach(['none', 'ground', 'submerged'] as $value) { ?>
    <option value="<?= $value ?>" <?= isset($upd_enclosure) && $upd_enclosure['water_level'] === $value? 'selected': (!isset($upd_enclosure) && $value === 'none'? 'selected': '') ?>><?= $value ?></option>
    <?php } ?>
  </select>
  <label>Water Type</label>
  <select name="water-type">
    <option value="__null__" <?= isset($upd_enclosure) && $upd_enclosure['water_type'] === NULL? 'selected': '' ?>>Not specified</option>
    <?php foreach(['none', 'salt-water', 'fresh-water', 'brackish-water'] as $value) { ?>
    <option value="<?= $value ?>" <?= isset($upd_enclosure) && $upd_enclosure['water_type'] === $value? 'selected': (!isset($upd_enclosure) && $value === 'none'? 'selected': '') ?>><?= $value ?></option>
    <?php } ?>
  </select>
  <label>Sun Exposure</label>
  <select name="sun-exposure">
    <option value="" <?= !isset($upd_enclosure) || $upd_enclosure['sun_exposure'] === NULL? 'selected': '' ?>>Not specified</option>
    <?php foreach(['low', 'moderate', 'high'] as $value) { ?>
    <option value="<?= $value ?>" <?= isset($upd_enclosure) && $upd_enclosure['sun_exposure'] === $value? 'selected': '' ?>><?= $value ?></option>
    <?php } ?>
  </select>
  <label>Vegetation</label>
  <select name="vegetation">
    <option value="" <?= !isset($upd_enclosure) || $upd_enclosure['vegetation'] === NULL? 'selected': '' ?>>Not specified</option>
    <?php foreach(['low', 'moderate', 'high'] as $value) { ?>
    <option value="<?= $value ?>" <?= isset($upd_enclosure) && $upd_enclosure['vegetation'] === $value? 'selected': '' ?>><?= $value ?></option>
    <?php } ?>
  </select>
  <label>Security</label>
  <select name="security">
    <option value="" <?= !isset($upd_enclosure) || $upd_enclosure['security'] === NULL? 'selected': '' ?>>Not specified</option>
    <?php foreach(['low', 'moderate', 'high'] as $value) { ?>
    <option value="<?= $value ?>" <?= isset($upd_enclosure) && $upd_enclosure['security'] === $value? 'selected': '' ?>><?= $value ?></option>
    <?php } ?>
  </select>
  <label>Is Indoor?</label>
  <select name="is-indoor">
    <option value="__null__" <?= isset($upd_enclosure) && $upd_enclosure['is_indoor'] === NULL? 'selected': '' ?>>Not specified</option>
    <?php foreach(['1' => 'Yes', '0' => 'No'] as $value => $label) { ?>
    <option value="<?= $value ?>" <?= isset($upd_enclosure) && $upd_enclosure['is_indoor'] === $value? 'selected': (!isset($upd_enclosure) && $value === '1'? 'selected': '') ?>><?= $label ?></option>
    <?php } ?>
  </select>
  <label>Status</label>
  <select name="status" required>
    <?php foreach(['empty', 'closed', 'under maintenance', 'public'] as $value) { ?>
    <option value="<?= $value ?>" <?= isset($upd_enclosure) && $upd_enclosure['status'] === $value? 'selected': (!isset($upd_enclosure) && $value === 'empty'? 'selected': '') ?>><?= $value ?></option>
    <?php } ?>
  </select>
  <label>Last Maintained</label>
  <input type="date" name="last-maintained-at" id="last-maintained-at" value="<?= isset($upd_enclosure)? $upd_enclosure['last_maintained_at'] ?? '': '' ?>">
  <button type="submit" name="<?= isset($_GET['update-id'])? 'update': 'create' ?>-enclosure">Submit</button>
</form>

<h3 class="title">Enclosure List</h3>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Size</th>
    <th>Water Level</th>
    <th>Water Type</th>
    <th>Sun Exposure</th>
    <th>Vegetation Density</th>
    <th>Security</th>
    <th>Is Indoor?</th>
    <th>Status</th>
    <th>Last Maintained</th>
    <th>Action</th>
  </tr>
  <?php 
    $enclosures = $enclosure->getAll();

    foreach($enclosures as $e) {
    $enclosure_id = htmlspecialchars($e['id'], ENT_QUOTES, 'UTF-8');
  ?>
  <tr>
  <td><?= $enclosure_id ?></td>
    <td><?= $e['size'] === NULL? '-': $e['size'].'m<sup>2</sup>' ?></td>
    <td><?= $e['water_level'] ?? '-' ?></td>
    <td><?= $e['water_type'] ?? '-' ?></td>
    <td><?= $e['sun_exposure'] ?? '-' ?></td>
    <td><?= $e['vegetation'] ?? '-' ?></td>
    <td><?= $e['security'] ?? '-' ?></td>
    <td><?= $e['is_indoor'] === NULL? '-': ($e['is_indoor']? "yes": "no") ?></td>
    <td><?= $e['status'] ?></td>
    <td><?= $e['last_maintained_at'] ?? "-" ?></td>
    <td>
      <form method="POST">
        <input type="hidden" name="id" value="<?= $enclosure_id ?>">
        <a href="?page=enclosures&update-id=<?= urlencode($e['id']) ?>" class="btn btn-warning">Update</a>
        <button type="submit" class="btn-danger" name="delete-enclosure" onclick="return confirm('Delete this enclosure?')">Delete</button>
      </form>
    </td>
  </tr>
  <?php } ?>
</table>