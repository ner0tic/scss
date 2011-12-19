<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_district->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $scss_district->getName() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $scss_district->getCode() ?></td>
    </tr>
    <tr>
      <th>Img:</th>
      <td><?php echo $scss_district->getImg() ?></td>
    </tr>
    <tr>
      <th>Zone:</th>
      <td><?php echo $scss_district->getZoneId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_district->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_district->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_district->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('district/edit?id='.$scss_district->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('district/index') ?>">List</a>
