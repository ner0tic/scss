<h1>Scss staffs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Dob</th>
      <th>Cabin</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($scss_staffs as $scss_staff): ?>
    <tr>
      <td><a href="<?php echo url_for('staff/show?id='.$scss_staff->getId()) ?>"><?php echo $scss_staff->getId() ?></a></td>
      <td><?php echo $scss_staff->getFirstName() ?></td>
      <td><?php echo $scss_staff->getLastName() ?></td>
      <td><?php echo $scss_staff->getDob() ?></td>
      <td><?php echo $scss_staff->getCabinId() ?></td>
      <td><?php echo $scss_staff->getCreatedAt() ?></td>
      <td><?php echo $scss_staff->getUpdatedAt() ?></td>
      <td><?php echo $scss_staff->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('staff/new') ?>">New</a>
