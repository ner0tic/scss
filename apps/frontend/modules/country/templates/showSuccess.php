<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_country->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $scss_country->getName() ?></td>
    </tr>
    <tr>
      <th>Iso code2:</th>
      <td><?php echo $scss_country->getIsoCode2() ?></td>
    </tr>
    <tr>
      <th>Iso code3:</th>
      <td><?php echo $scss_country->getIsoCode3() ?></td>
    </tr>
    <tr>
      <th>Address format:</th>
      <td><?php echo $scss_country->getAddressFormatId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_country->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_country->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_country->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('country/edit?id='.$scss_country->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('country/index') ?>">List</a>
