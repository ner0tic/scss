<h1>Scss troop enrollments List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Troop</th>
      <th>Week</th>
      <th>Site</th>
      <th>Rotation</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($scss_troop_enrollments as $scss_troop_enrollment): ?>
    <tr>
      <td><a href="<?php echo url_for('troopEnrollment/edit?id='.$scss_troop_enrollment->getId()) ?>"><?php echo $scss_troop_enrollment->getId() ?></a></td>
      <td><?php echo $scss_troop_enrollment->getTroopId() ?></td>
      <td><?php echo $scss_troop_enrollment->getWeekId() ?></td>
      <td><?php echo $scss_troop_enrollment->getSiteId() ?></td>
      <td><?php echo $scss_troop_enrollment->getRotationId() ?></td>
      <td><?php echo $scss_troop_enrollment->getCreatedAt() ?></td>
      <td><?php echo $scss_troop_enrollment->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('troopEnrollment/new') ?>">New</a>
