<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_zone->getId() ?></td>
    </tr>
    <tr>
      <th>Country:</th>
      <td><?php echo $scss_zone->getCountryId() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $scss_zone->getCode() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $scss_zone->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_zone->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_zone->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_zone->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('zone/edit?id='.$scss_zone->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('zone/index') ?>">List</a>
