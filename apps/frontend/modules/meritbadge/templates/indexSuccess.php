<h1>Scss merit badges List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Num reqs</th>
      <th>Tte</th>
      <th>Img</th>
      <th>Created at</th>
      <th>Updated at</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($scss_merit_badges as $scss_merit_badge): ?>
    <tr>
      <td><a href="<?php echo url_for('meritbadge/show?id='.$scss_merit_badge->getId()) ?>"><?php echo $scss_merit_badge->getId() ?></a></td>
      <td><?php echo $scss_merit_badge->getName() ?></td>
      <td><?php echo $scss_merit_badge->getNumReqs() ?></td>
      <td><?php echo $scss_merit_badge->getTte() ?></td>
      <td><?php echo $scss_merit_badge->getImg() ?></td>
      <td><?php echo $scss_merit_badge->getCreatedAt() ?></td>
      <td><?php echo $scss_merit_badge->getUpdatedAt() ?></td>
      <td><?php echo $scss_merit_badge->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('meritbadge/new') ?>">New</a>
