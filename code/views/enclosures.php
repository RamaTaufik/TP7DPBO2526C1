<h3 class="title">Add Enclosure</h3>
<form method="POST">
  <label>ID</label>
  <input type="text" name="id" id="id">
  <button type="submit" name="create-enclosure">Create</button>
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
  ?>
  <tr>
    <td><?= $e['id'] ?></td>
    <td><?= $e['size'] ?>m<sup>2</sup></td>
    <td><?= $e['water_level'] ?></td>
    <td><?= $e['water_type'] ?></td>
    <td><?= $e['sun_exposure'] ?></td>
    <td><?= $e['vegetation'] ?></td>
    <td><?= $e['security'] ?></td>
    <td><?= $e['is_indoor']? "yes": "no" ?></td>
    <td><?= $e['status'] ?></td>
    <td><?= $e['last_maintained_at'] ?? "-" ?></td>
    <td>
      <!-- <a href="?page=animals&return=<?= $e['id'] ?>">Return</a> -->
    </td>
  </tr>
  <?php } ?>
</table>