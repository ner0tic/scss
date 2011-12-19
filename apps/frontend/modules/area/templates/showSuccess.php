<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_area->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $scss_area->getName() ?></td>
    </tr>
    <tr>
      <th>Parent:</th>
      <td><?php echo $scss_area->getParentId() ?></td>
    </tr>
    <tr>
      <th>Camp:</th>
      <td><?php echo $scss_area->getCampId() ?></td>
    </tr>
    <tr>
      <th>Staff:</th>
      <td><?php echo $scss_area->getStaffId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_area->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_area->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_area->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('area/edit?id='.$scss_area->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('area/index') ?>">List</a>
