<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_staff->getId() ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $scss_staff->getFirstName() ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $scss_staff->getLastName() ?></td>
    </tr>
    <tr>
      <th>Dob:</th>
      <td><?php echo $scss_staff->getDob() ?></td>
    </tr>
    <tr>
      <th>Cabin:</th>
      <td><?php echo $scss_staff->getCabinId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_staff->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_staff->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_staff->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('staff/edit?id='.$scss_staff->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('staff/index') ?>">List</a>
