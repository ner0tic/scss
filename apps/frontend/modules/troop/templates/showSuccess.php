<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_troop->getId() ?></td>
    </tr>
    <tr>
      <th>Number:</th>
      <td><?php echo $scss_troop->getNumber() ?></td>
    </tr>
    <tr>
      <th>Img:</th>
      <td><?php echo $scss_troop->getImg() ?></td>
    </tr>
    <tr>
      <th>District:</th>
      <td><?php echo $scss_troop->getDistrictId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $scss_troop->getUserId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_troop->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_troop->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_troop->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('troop/edit?id='.$scss_troop->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('troop/index') ?>">List</a>
