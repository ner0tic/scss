<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_period->getId() ?></td>
    </tr>
    <tr>
      <th>Label:</th>
      <td><?php echo $scss_period->getLabel() ?></td>
    </tr>
    <tr>
      <th>Start time:</th>
      <td><?php echo $scss_period->getStartTime() ?></td>
    </tr>
    <tr>
      <th>End time:</th>
      <td><?php echo $scss_period->getEndTime() ?></td>
    </tr>
    <tr>
      <th>Tte:</th>
      <td><?php echo $scss_period->getTte() ?></td>
    </tr>
    <tr>
      <th>Week:</th>
      <td><?php echo $scss_period->getWeekId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_period->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_period->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_period->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('period/edit?id='.$scss_period->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('period/index') ?>">List</a>
