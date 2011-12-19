<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_class->getId() ?></td>
    </tr>
    <tr>
      <th>Course:</th>
      <td><?php echo $scss_class->getCourseId() ?></td>
    </tr>
    <tr>
      <th>Area:</th>
      <td><?php echo $scss_class->getAreaId() ?></td>
    </tr>
    <tr>
      <th>Period:</th>
      <td><?php echo $scss_class->getPeriodId() ?></td>
    </tr>
    <tr>
      <th>Staff:</th>
      <td><?php echo $scss_class->getStaffId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_class->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_class->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('class/edit?id='.$scss_class->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('class/index') ?>">List</a>
