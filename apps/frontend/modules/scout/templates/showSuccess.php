<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scout->getId() ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $scout->getFirstName() ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $scout->getLastName() ?></td>
    </tr>
    <tr>
      <th>Dob:</th>
      <td><?php echo $scout->getDob() ?></td>
    </tr>
    <tr>
      <th>Patrol:</th>
      <td><?php echo $scout->getPatrolId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scout->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scout->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scout->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('scout/edit?id='.$scout->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('scout/index') ?>">List</a>
