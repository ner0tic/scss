<?php load_assets('district') ?>
<?php load_assets('data-table') ?>
<?php include_partial("global/infobox", array('page'=>'district')) ?>
<div class="box main-content">
  <div class="box-content datagrid">
    <h2>Districts</h2>
    <table class="data-table" id="district-table">
      <tbody>
<?php foreach($pager->getResults() as $i => $district): ?>
        <tr class="table-row <?php echo fmod($i,2) ? 'even-row' : 'odd-row' ?>">
          <td><?php echo link_to(ucwords($district->getName()), @camps_by_district,array(
                          'country_slug'  =>  $district->getZone()->getCountry()->getSlug(),
                          'zone_slug'     =>  $district->getZone()->getSlug(),
                          'district_slug' =>  $district->getSlug())) ?></td>
          <td><?php echo $district->getCode() ?></td>
          <td><?php echo $district->getZone()->getName().', '.$district->getZone()->getCountry()->getIsoCode2() ?></td>
          <td class="table-controls">
            <div class="table-controls">
              <a href="<?php echo url_for('district/edit?id='.$district->getId()) ?>">
              <a href="<?php echo url_for('district/edit?id='.$district->getId()) ?>">
                    <img src="/images/icons/edit-icon.png" width="16" height="16" alt="edit" />
                    <span class="control-txt">edit</span>
                  </a>
                  <a href="<?php echo url_for('district/edit?id='.$district->getId()) ?>">
                    <img src="/images/icons/delete-icon.png" width="16" height="16" alt="delete" />
                    <span class="control-txt">delete</span>
                  </a>
                <div>
              </td>
            </tr>
<?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">
                <div class="pagination_desc">
                  <strong><?php echo count($pager) ?></strong> districts found
<?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
<?php endif; ?>
                </div>
<?php if($pager->haveToPaginate()): ?>
                <div class="pagination">
  <?php echo link_to("&larr;",$route.'&page='.$pager->getFirstPage()) ?>
  <?php echo link_to("&laquo;",$route,array('page'=>$pager->getPreviousPage())) ?>
  <?php foreach($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
                  <?php echo link_to($page,$route,array('page'=>$page))?>
  <?php endif; endforeach; ?>
  <?php echo link_to("&raquo;",$route,array('page'=>$pager->getNextPage())) ?>
  <?php echo link_to("&rarr;",$route,array('page'=>$pager->getLastPage())) ?>
                </div>
<?php endif; ?>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
