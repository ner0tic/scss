<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_merit_badge->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $scss_merit_badge->getName() ?></td>
    </tr>
    <tr>
      <th>Num reqs:</th>
      <td><?php echo $scss_merit_badge->getNumReqs() ?></td>
    </tr>
    <tr>
      <th>Tte:</th>
      <td><?php echo $scss_merit_badge->getTte() ?></td>
    </tr>
    <tr>
      <th>Img:</th>
      <td><?php echo $scss_merit_badge->getImg() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_merit_badge->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_merit_badge->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_merit_badge->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('meritbadge/edit?id='.$scss_merit_badge->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('meritbadge/index') ?>">List</a>
