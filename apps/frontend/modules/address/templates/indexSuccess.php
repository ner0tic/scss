<h1>Scss address books List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Label</th>
      <th>Street</th>
      <th>Suburb</th>
      <th>City</th>
      <th>Zone</th>
      <th>Postal code</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($scss_address_books as $scss_address_book): ?>
    <tr>
      <td><a href="<?php echo url_for('address/show?id='.$scss_address_book->getId()) ?>"><?php echo $scss_address_book->getId() ?></a></td>
      <td><?php echo $scss_address_book->getLabel() ?></td>
      <td><?php echo $scss_address_book->getStreet() ?></td>
      <td><?php echo $scss_address_book->getSuburb() ?></td>
      <td><?php echo $scss_address_book->getCity() ?></td>
      <td><?php echo $scss_address_book->getZoneId() ?></td>
      <td><?php echo $scss_address_book->getPostalCode() ?></td>
      <td><?php echo $scss_address_book->getCreatedAt() ?></td>
      <td><?php echo $scss_address_book->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('address/new') ?>">New</a>
