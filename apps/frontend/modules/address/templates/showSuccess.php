<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $scss_address_book->getId() ?></td>
    </tr>
    <tr>
      <th>Label:</th>
      <td><?php echo $scss_address_book->getLabel() ?></td>
    </tr>
    <tr>
      <th>Street:</th>
      <td><?php echo $scss_address_book->getStreet() ?></td>
    </tr>
    <tr>
      <th>Suburb:</th>
      <td><?php echo $scss_address_book->getSuburb() ?></td>
    </tr>
    <tr>
      <th>City:</th>
      <td><?php echo $scss_address_book->getCity() ?></td>
    </tr>
    <tr>
      <th>Zone:</th>
      <td><?php echo $scss_address_book->getZoneId() ?></td>
    </tr>
    <tr>
      <th>Postal code:</th>
      <td><?php echo $scss_address_book->getPostalCode() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $scss_address_book->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $scss_address_book->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('address/edit?id='.$scss_address_book->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('address/index') ?>">List</a>
