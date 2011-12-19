<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_course->getId() ?></td>
    </tr>
    <tr>
      <th>Label:</th>
      <td><?php echo $scss_course->getLabel() ?></td>
    </tr>
    <tr>
      <th>Meritbadge:</th>
      <td><?php echo $scss_course->getMeritbadgeId() ?></td>
    </tr>
    <tr>
      <th>Camp:</th>
      <td><?php echo $scss_course->getCampId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_course->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_course->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_course->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('course/edit?id='.$scss_course->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('course/index') ?>">List</a>
