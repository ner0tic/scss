<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_camp->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $scss_camp->getName() ?></td>
    </tr>
    <tr>
      <th>Address:</th>
      <td><?php echo $scss_camp->getAddressId() ?></td>
    </tr>
    <tr>
      <th>District:</th>
      <td><?php echo $scss_camp->getDistrictId() ?></td>
    </tr>
    <tr>
      <th>Phone:</th>
      <td><?php echo $scss_camp->getPhone() ?></td>
    </tr>
    <tr>
      <th>Fax:</th>
      <td><?php echo $scss_camp->getFax() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $scss_camp->getEmail() ?></td>
    </tr>
    <tr>
      <th>Url:</th>
      <td><?php echo $scss_camp->getUrl() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_camp->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_camp->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $scss_camp->getSlug() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('camp/edit?id='.$scss_camp->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('camp/index') ?>">List</a>
