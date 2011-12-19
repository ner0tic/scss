<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_scout_enrollment->getId() ?></td>
    </tr>
    <tr>
      <th>Scout:</th>
      <td><?php echo $scss_scout_enrollment->getScoutId() ?></td>
    </tr>
    <tr>
      <th>Class:</th>
      <td><?php echo $scss_scout_enrollment->getClassId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_scout_enrollment->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_scout_enrollment->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('scoutEnrollment/edit?id='.$scss_scout_enrollment->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('scoutEnrollment/index') ?>">List</a>
