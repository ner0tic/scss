<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_week->getId() ?></td>
    </tr>
    <tr>
      <th>Label:</th>
      <td><?php echo $scss_week->getLabel() ?></td>
    </tr>
    <tr>
      <th>Start date:</th>
      <td><?php echo $scss_week->getStartDate() ?></td>
    </tr>
    <tr>
      <th>End date:</th>
      <td><?php echo $scss_week->getEndDate() ?></td>
    </tr>
    <tr>
      <th>Tte:</th>
      <td><?php echo $scss_week->getTte() ?></td>
    </tr>
    <tr>
      <th>Camp:</th>
      <td><?php echo $scss_week->getCampId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_week->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_week->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_week->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('week/edit?id='.$scss_week->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('week/index') ?>">List</a>
