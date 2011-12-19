<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_patrol->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $scss_patrol->getName() ?></td>
    </tr>
    <tr>
      <th>Img:</th>
      <td><?php echo $scss_patrol->getImg() ?></td>
    </tr>
    <tr>
      <th>Color:</th>
      <td><?php echo $scss_patrol->getColor() ?></td>
    </tr>
    <tr>
      <th>Troop:</th>
      <td><?php echo $scss_patrol->getTroopId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_patrol->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_patrol->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_patrol->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('patrol/edit?id='.$scss_patrol->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('patrol/index') ?>">List</a>
